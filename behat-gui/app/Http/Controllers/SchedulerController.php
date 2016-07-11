<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Scheduler;
use Illuminate\Http\Request;

class SchedulerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$schedulers = Scheduler::orderBy('id', 'desc')->paginate(10);

		return view('schedulers.index', compact('schedulers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('schedulers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$scheduler = new Scheduler();

		$scheduler->command = $request->input("command");
    $scheduler->parameters = $request->input("parameters");
    $scheduler->frequency = $request->input("frequency");
		$scheduler->disabled = $request->input('disabled');

		$scheduler->save();

		return redirect()->route('schedulers.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$scheduler = Scheduler::findOrFail($id);

		return view('schedulers.show', compact('scheduler'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$scheduler = Scheduler::findOrFail($id);

		return view('schedulers.edit', compact('scheduler'));
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
		$scheduler = Scheduler::findOrFail($id);

		$scheduler->command = $request->input("command");
    $scheduler->parameters = $request->input("parameters");
    $scheduler->frequency = $request->input("frequency");
		$scheduler->disabled = $request->input('disabled');

		$scheduler->save();

		return redirect()->route('schedulers.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$scheduler = Scheduler::findOrFail($id);
		$scheduler->delete();

		return redirect()->route('schedulers.index')->with('message', 'Item deleted successfully.');
	}

}
