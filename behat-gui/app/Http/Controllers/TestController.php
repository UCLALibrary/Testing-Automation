<?php namespace App\Http\Controllers;

use App\Notifications;

use App\Category;
use App\CategoryItem;
use App\Group;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\Categories;
use App\Jobs\Execute;
use App\Set;
use App\Test;
use App\TestResult;
use App\Variable;
use Behat\Gherkin\Keywords\ArrayKeywords;
use Behat\Gherkin\Lexer;
use Behat\Gherkin\Parser;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use PHPHtmlParser\Dom;

class TestController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$order = TestResult::orderBy('created_at', 'desc')->get();
		$te = [];
		$status = [];
		$categories = [];
		$ids = Test::select('id')->where('id', '>', 0)->get()->toArray();
		foreach($order as $o){
			if (!isset($te[$o->test_id])) {
				$tes = Test::where('id', '=', $o->test_id)->first();
				if ($tes != null) {
					$te[$o->test_id] = $tes;
				}
			}
		}
		foreach($ids as $id){

			if(!isset($te[$id['id']])){
				$te[$id['id']] = Test::where('id', '=', $id['id'])->first();
			}
		}

		$tests = collect($te);

		$it = [];
		$items = CategoryItem::all();
		foreach($items as $i){
			$it[$i->header][] = $i->value;
		}

		$groups = Group::orderBy('created_at', 'desc')->limit(10)->get();

        foreach($tests as $t){
			$r = TestResult::where('test_id', '=', $t->id)->orderBy('created_at', 'desc')->limit(1)->first();
			if($r != null) {
                $status[$t->id]['success'] = $r->success;
				$status[$t->id]['timestamp'] = $r->created_at;
            }

			$c = Category::where('test_id', '=', $t->id)->get();
			foreach($c as $c) {
				$categories[$t->id][$c->id] = $c->category;
			}

        }

		view()->share('items', $it);
        view()->share('sets', Set::all());
        return view('tests.index', compact('tests', 'status', 'categories', 'groups'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tests.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$test = new Test();
		$test->name = $request->input("name");
		$name = md5(time()).".feature.template";
		if($request->hasFile('location')){
            if($request->file('location')->isValid()){
                $request->file('location')->move(base_path()."/features", $name);
            }
        }

        if($request->file('location')->getClientOriginalExtension() != 'feature'){
            return redirect()->back()->withErrors(['File must be a feature (.feature)']);
        }

        $file = str_replace(" ", " ", file_get_contents(base_path().'/features/'.$name));
		$md5 = md5($file);
        file_put_contents(base_path()."/features/".$name, $file);

        $test->location = base_path()."/features/".$name;
		$test->md5 = $md5;

		$test->save();

		return redirect()->route('tests.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$test = Test::findOrFail($id);
        $results = TestResult::where('test_id', '=', $test->id)->orderBy('created_at', 'desc')->limit(5)->get();

		return view('tests.show', compact('test', 'results'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$test = Test::findOrFail($id);

		return view('tests.edit', compact('test'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$test = Test::findOrFail($id);

		$test->name = $request->input("name");

		file_put_contents($test->location, str_replace(" ", " ", $request->input('location')));

        $test->save();

		return redirect()->route('tests.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$test = Test::findOrFail($id);

        unlink($test->location);

		$test->delete();

		return redirect()->route('tests.index')->with('message', 'Item deleted successfully.');
	}

	public function destory_multiple($id){
		$array = explode(",", $id);
		foreach($array as $item){
			$test = Test::findOrFail($item);
			unlink($test->location);
			$test->delete();
		}
		return redirect()->route('tests.index')->with('message', 'Items deleted successfully.');
	}

    public function execute(Request $request, $id){
        $group = Group::create(['user_id' => Auth::user()->id]);

        $this->dispatch(
            new Execute($request->user(), $id, $request->input('set'), $group->id)
        );
        
        return redirect()->back()->with('message', 'Test queued.');
    }

	public function category($id){
        if(Test::where('id', '=', $id)->first() != null){
            $it = [];
            $items = CategoryItem::all();
            foreach($items as $i){
                $it[$i->header][] = $i->value;
            }

            view()->share('items', $it);
            view()->share('id', $id);
            return view('tests.category');
        }else{
            return redirect()->route('tests.index')->withErrors(["Test does not exist"]);
        }
	}

	public function delete_category($id){
        Category::where('id', '=', $id)->first()->delete();
        return redirect()->route('tests.index')->with('message', 'Category deleted');
	}

	public function category_store(Request $request, $id){
        if(strpos($id,",") !== false){
            $array = explode(",", $id);
            foreach($array as $item){
                if(empty(Category::where('test_id', '=', $item)->where('category', '=', $request->input('category'))->first())) {
                    $category = new Category();
                    $category->test_id = $item;
                    $category->category = $request->input('category');
                    $category->save();
                }
            }
            return redirect()->route('tests.index')->with('message', 'Category added successfully.');
        }else{
            if(empty(Category::where('test_id', '=', $id)->where('category', '=', $request->input('category'))->first())) {
                $category = new Category();
                $category->test_id = $id;
                $category->category = $request->input('category');
                $category->save();

                return redirect()->route('tests.index')->with('message', 'Category added successfully.');
            }else{
                return redirect()->route('tests.index')->with('message', 'Category already assigned');
            }
        }
	}

	public function get_results(){
		$r = TestResult::where('comment_complete', '=', 0)->get();
        $return = [];
        foreach($r as $r) {
            $return[] = [
                'result' => $r->result,
                'id' => $r->id,
            ];
        }
		echo json_encode($return);
	}

    public function put_comments(Request $request, $id){
        $r = TestResult::where('id', '=', $id)->first();
        $r->comment = $request->input('comment');
        $r->comment_complete = 1;
        $r->save();

        echo 'true';
    }

	public function execute_category(Request $request)
    {
        $group = Group::create(['user_id' => Auth::user()->id]);
        foreach ($request->input('categories')[0] as $category){
			$this->dispatch(
                new Categories($request->user(), $category, $request->input('set'), $group->id)
            );
        }

        print_r('done');
	}

	public function compiled($test, $set){
		$t = \App\Test::where('id', '=', $test)->first();
		$file = file_get_contents($t->location);
		$file = str_replace(" ", " ", $file);

		$s = "/\[([a-zA-Z\/_]+)\]/";
		preg_match_all($s, $file, $match);
		foreach($match[1] as $m) {
			$variable = Variable::where('key', '=', $m)->first();
			if(!empty($variable)) {
				$sets = json_decode($variable->sets);
				if (in_array($set, $sets)) {
					if (isset(json_decode($variable->value)[$set]) && json_decode($variable->value)[$set] != null) {
						$file = str_replace("[" . $m . "]", json_decode($variable->value)[$set], $file);
					} elseif (!isset(json_decode($variable->value)[$set]) || json_decode($variable->value)[$set] == null) {
						$file = str_replace("[" . $m . "]", json_decode($variable->value)[0], $file);
					} else {
						$file = str_replace("[" . $m . "]", json_decode($variable->value)[0], $file);
					}
				} else {
					$file = str_replace("[" . $m . "]", json_decode($variable->value)[0], $file);
				}
			}
		}

		$data = $file;

		$name = explode('.', $t->location)[0];

		$keywords = new ArrayKeywords([
			'en' => array(
				'feature'          => 'Feature',
				'background'       => 'Background',
				'scenario'         => 'Scenario',
				'scenario_outline' => 'Scenario Outline|Scenario Template',
				'examples'         => 'Examples|Scenarios',
				'given'            => 'Given',
				'when'             => 'When',
				'then'             => 'Then',
				'and'              => 'And',
				'but'              => 'But'
			)
		]);

		$lexer = new Lexer($keywords);
		$parser = new Parser($lexer);

		$info = $parser->parse($data);
		$file = '# language: '. $info->getLanguage();

		foreach($info->getTags() as $t){
			$file .= "\n@". $t;
		}

		$file .= "\nFeature: ". $info->getTitle();
		foreach(explode("\n", $info->getDescription()) as $d){
			$file .= "\n  ". trim($d);
		}

		if($info->getBackground() !== null) {
			$background = $info->getBackground();
			$file .= "\n\n  " . $background->getKeyword() . ": ";
			if ($background->getTitle() != null) {
				$file .= $background->getTitle();
			}

			foreach ($background->getSteps() as $step) {
				$file .= "\n    " . trim($step->getKeyword()) . " " . trim($step->getText());
			}
		}


		$file .= "\n";
		foreach($info->getScenarios() as $s){
			foreach($s->getTags() as $t){
				$file .= "\n  @". $t;
			}
			$file .= "\n  ".$s->getKeyword(). ": ";
			foreach(explode("\n", $s->getTitle()) as $k => $t){
				if($k == 0){
					$file .= trim($t);
				}else{
					$file .= "\n    " . trim($t);
				}
			}
			foreach($s->getSteps() as $step){

				$string = $step->getKeyword(). " ". $step->getText();
				$file .= "\n    ".$string;
			}


		}

		header('Content-type: text/plain');
		header('Content-Disposition: attachment; filename="'.last(explode("/", $name)).'.feature"');
		echo $file;
	}


	public function search($search){
		$tests = Test::where('name', 'like', '%'.$search.'%')->get();

		$it = [];
		$items = CategoryItem::all();
		foreach($items as $i){
			$it[$i->header][] = $i->value;
		}

		$status = [];
		$categories = [];
		foreach($tests as $t){
			$r = TestResult::where('test_id', '=', $t->id)->orderBy('created_at', 'desc')->limit(1)->first();
			if($r != null) {
				$status[$t->id]['success'] = $r->success;
				$status[$t->id]['timestamp'] = $r->created_at;
			}

			$c = Category::where('test_id', '=', $t->id)->get();
			foreach($c as $c) {
				$categories[$t->id][] = $c->category;
			}

		}

		view()->share('items', $it);
		view()->share('sets', Set::all());
		return view('tests.index', compact('tests', 'status', 'categories'));
	}

	public function group_show($id){
		$group = Group::where('id','=',$id)->first();
		$output = [];
		if(!empty($group->results)) {
			foreach ($group->results as $re) {
				$res = TestResult::where('id', '=', $re)->first();
				$dom = new Dom();
				$dom->load($res->result);
				$name = $dom->find('a[data-toggle=collapse]');
				$output[$res->id] = "";
				foreach ($name as $n) {

					$output[$res->id] .= "<div class=\"ui fluid accordion\">";
					$items = $dom->find('li');
					$result = [];
					foreach ($items as $ke => $item) {
						$color = 'black';
						if (strpos($item->class, "alert-warning") !== false) {
							$color = '#f79232';
						} elseif (strpos($item->class, "alert-danger") !== false) {
							$color = '#d04437';
						} elseif (strpos($item->class, "alert-success") !== false) {
							$color = '#14892c';
						} elseif (strpos($item->class, "alert-info") !== false) {
							$color = '#59afe1';
						}

						$result[] = [
							'id' => "#".$items[$ke]->getParent()->getParent()->id,
							'line' => $item->text,
							'color' => $color
						];
					}

					$failed = false;
					if(strpos($n->getParent()->getParent()->getParent()->class, 'failed') !== false){
						$failed = true;
					}

					if($failed == true) {
						$output[$re] .= "<div class=\"title\" style=\"color:#d04437;\">" . trim($n->text) . "</div><div class=\"content\"><div class=\"transition hidden\">";
					}elseif($failed == false){
						$output[$re] .= "<div class=\"title\">" . trim($n->text) . "</div><div class=\"content\"><div class=\"transition hidden\">";
					}
					$output[$re] .= "<ul>";
					foreach ($result as $k => $r) {
						if ($result[$k]['id'] == $n->href) {
							$output[$re] .= "<li style=\"color:" . $result[$k]['color'] . "\" >" . $result[$k]['line'] . "</li>";
						}
					}
					$output[$re] .= "</ul>";
					$output[$re] .= "</div></div></div></div>";
				}

			}
		}
		return view('tests.groups.show', compact('group', 'output'));
	}
}
