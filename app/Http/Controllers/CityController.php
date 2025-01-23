<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cities = City::with('state');

        if($request->has('search')){
            $cities->where('city_name', 'LIKE', '%' . $request->search . '%');
        }

        return view('cities.index', ['cities' => $cities->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::all();
        return view('cities.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'city_name' => 'required|unique:cities,city_name',
            'state_id' => 'required|exists:states,id',
        ]);

        City::create($request->only('city_name','state_id'));
        return redirect()->route('cities.index')->with('success', 'Cities created successfully .');
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
    public function edit(City $city)
    {
        $states = State::all();
        return view('cities.edit', compact('city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'city_name' => 'required|unique:cities,city_name,' . $city->id,
            'state_id' => 'required|exists:states,id',
        ]);

        $city->update($request->only('city_name','state_id'));
        return redirect()->route('cities.index')->with('success','Cities Updated Successfully .');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')->with('success','Cities deleted successfully .');
    }
}
