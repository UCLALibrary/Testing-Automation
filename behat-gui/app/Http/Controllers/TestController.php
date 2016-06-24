<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\Execute;
use App\Test;
use App\TestResult;
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

        return view('tests.index', compact('tests'));
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

		file_put_contents($test->location, $request->input('location'));

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
