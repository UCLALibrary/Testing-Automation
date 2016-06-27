<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FeatureContext;
use Illuminate\Http\Request;

class FeatureContextController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$feature_contexts = file_get_contents(base_path()."/features/bootstrap/FeatureContext.php");

		return view('feature_contexts.index', compact('feature_contexts'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		$feature_context = file_get_contents(base_path()."/features/bootstrap/FeatureContext.php");

		return view('feature_contexts.edit', compact('feature_context'));
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
		$feature_context = FeatureContext::findOrFail($id);

		$feature_context->function = $request->input("function");
        $feature_context->name = $request->input("name");

		$feature_context->save();

		return redirect()->route('feature_contexts.index')->with('message', 'Item updated successfully.');
	}

}
