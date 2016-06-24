<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Variable;
use Illuminate\Http\Request;

class VariableController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$variables = Variable::orderBy('id', 'desc')->paginate(50);

		return view('variables.index', compact('variables'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('variables.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$variable = new Variable();

		$variable->key = $request->input("key");
        $variable->value = $request->input("value");

		$variable->save();

		return redirect()->route('variables.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$variable = Variable::findOrFail($id);

		return view('variables.show', compact('variable'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$variable = Variable::findOrFail($id);

		return view('variables.edit', compact('variable'));
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
		$variable = Variable::findOrFail($id);

		$variable->key = $request->input("key");
        $variable->value = $request->input("value");

		$variable->save();

		return redirect()->route('variables.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$variable = Variable::findOrFail($id);
		$variable->delete();

		return redirect()->route('variables.index')->with('message', 'Item deleted successfully.');
	}

}
