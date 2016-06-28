<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\Execute;
use App\Test;
use App\TestResult;
use Behat\Gherkin\Keywords\ArrayKeywords;
use Behat\Gherkin\Lexer;
use Behat\Gherkin\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class TestController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tests = Test::orderBy('id', 'desc')->paginate(10);

        $status = [];
        $tags = [];
        foreach($tests as $t){
			$r = TestResult::where('test_id', '=', $t->id)->orderBy('created_at', 'desc')->limit(1)->first();
			if($r != null) {
                $status[$t->id]['success'] = $r->success;
				$status[$t->id]['timestamp'] = $r->created_at;
            }

            $name = $t->location;

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


            $p = $parser->parse(file_get_contents($name));
            $tags[$t->id] = $p->getTags();


        }


        return view('tests.index', compact('tests', 'status', 'tags'));
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

    public function execute($id){
        $this->dispatch(
            new Execute($id)
        );

        return redirect()->back()->with('message', 'Test Queued');
    }
}
