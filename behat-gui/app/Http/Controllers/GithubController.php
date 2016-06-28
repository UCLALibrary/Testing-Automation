<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Github;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GithubController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$githubs = Github::orderBy('id', 'desc')->paginate(10);

		return view('githubs.index', compact('githubs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('githubs.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$github = new Github();

		$github->headers = $request->input("headers");
        $github->payload = $request->input("payload");

		$github->save();

		return redirect()->route('githubs.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$github = Github::findOrFail($id);

		return view('githubs.show', compact('github'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$github = Github::findOrFail($id);

		return view('githubs.edit', compact('github'));
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
		$github = Github::findOrFail($id);

		$github->headers = $request->input("headers");
        $github->payload = $request->input("payload");

		$github->save();

		return redirect()->route('githubs.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$github = Github::findOrFail($id);
		$github->delete();

		return redirect()->route('githubs.index')->with('message', 'Item deleted successfully.');
	}

	public function payload(Request $request){
		$github = new Github();

		$github->headers = json_encode($request->header());
		$github->payload = json_encode($request->getContent());

		$github->save();

		return "Ok!";
	}

}
