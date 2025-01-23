<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $states = State::with('country');

        if($request->has('search')){
            $states->where('state_name', 'LIKE', '%' . $request->search . '%');
        }
        return view('states.index',['states' => $states->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('states.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'state_name' => 'required|unique:states,state_name',
            'country_id' => 'required|exists:countries,id',
        ]);

        State::create($request->only('state_name','country_id'));
        return redirect()->route('states.index')->with('success','States created successfully .');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $countries = Country::all();
        return view('states.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'state_name' => 'required|unique:states,state_name,' . $state->id,
            'country_id' => 'required|exists:countries,id',
        ]);

        $state->update($request->only('state_name','country_id'));
        return redirect()->route('states.index')->with('success','State updated successfully .');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();
        return redirect()->route('states.index')->with('success','State deleted successfully .');
    }
}
