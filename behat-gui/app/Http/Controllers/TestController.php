<?php namespace App\Http\Controllers;

use App\Category;
use App\CategoryItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\Categories;
use App\Jobs\Execute;
use App\Set;
use App\Test;
use App\TestResult;
use Illuminate\Http\Request;

class TestController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tests = Test::orderBy('id', 'desc')->paginate(10);

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

        $file = str_replace(" ", " ", file_get_contents(base_path().'/features/'.$name));
        file_put_contents(base_path()."/features/".$name, $file);

        $test->location = base_path()."/features/".$name;

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

    public function execute(Request $request, $id){
        $this->dispatch(
            new Execute($id, $request->input('set'))
        );

        return redirect()->back()->with('message', 'Test Queued');
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

	public function category_store(Request $request, $id){
			$category = new Category();
			$category->test_id = $id;
			$category->category = $request->input('category');
			$category->save();

			return redirect()->route('tests.index')->with('message', 'Category added successfully.');
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
        foreach ($request->input('categories') as $category){
            $this->dispatch(
                new Categories($category, $request->input('set'))
            );
        }

        return redirect()->route('tests.index')->with('message', 'Executed all tests relating to those categories');
	}

}
