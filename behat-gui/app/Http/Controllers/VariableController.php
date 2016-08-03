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

        $main = json_decode($request->input('main'), true);
        $data = json_decode($request->input('data'), true);

        $json_array = [
            $main['value'],
        ];
        $sets_array = ["0"];

        foreach($data as $d){
            $sets_array[] = $d['select'];
            $json_array[] = $d['input'];
        }

        $json = json_encode($json_array);
        $set = json_encode($sets_array);

		$variable->key = str_replace("&amp;", "&", $main['key']);
        $variable->value = $json;
        $variable->sets = $set;
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

        $main = json_decode($request->input('main'), true);
        $data = json_decode($request->input('data'), true);


        $json_array = [
            $main['value'],
        ];
        $sets_array = ["0"];

        foreach($data as $d){
            $sets_array[] = $d['select'];
            $json_array[] = $d['input'];
        }

        $json = json_encode($json_array);
        $set = json_encode($sets_array);


        $variable->key = $main['key'];
        $variable->value = $json;
        $variable->sets = $set;
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

	public function delete_value($id, $set){
		$var = Variable::where('id', '=', $id)->first();
		$sets = json_decode($var->sets, true);
		$value = json_decode($var->value, true);

		foreach($sets as $k => $s){
			if($set == $s){
				unset($sets[$k], $value[$k]);
			}
		}

		$var->sets = json_encode($sets);
		$var->value = json_encode($value);
		$var->save();

		return redirect()->route('variables.index')->with('message', 'Variable value deleted successfully.');

	}
}
