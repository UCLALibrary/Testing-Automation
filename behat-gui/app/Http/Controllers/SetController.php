<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Set;
use Illuminate\Http\Request;

class SetController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sets = Set::orderBy('id', 'desc')->paginate(10);

        return view('sets.index', compact('sets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('sets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $set = new Set();

        $set->name = $request->input("name");
        $set->description = $request->input("description");
        $set->user_id = '1';

        $set->save();

        return redirect()->route('sets.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $set = Set::findOrFail($id);

        return view('sets.show', compact('set'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $set = Set::findOrFail($id);

        return view('sets.edit', compact('set'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int       $id
     * @param  Request   $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $set = Set::findOrFail($id);

        $set->name = $request->input("name");
        $set->description = $request->input("description");
        $set->user_id = $request->input("user_id");

        $set->save();

        return redirect()->route('sets.index')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $set = Set::findOrFail($id);
        $set->delete();

        return redirect()->route('sets.index')->with('message', 'Item deleted successfully.');
    }

}
