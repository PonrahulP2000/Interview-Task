<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryCountroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $countries = Country::query();

        if($request->has('search')){
            $countries->where('country_name', 'LIKE', '%' . $request->search . '%');
        }
        return view('countries.index',['countries' => $countries->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['country_name' => 'required|unique:countries,country_name']);
        Country::create($request->only('country_name'));
        return redirect()->route('countries.index')->with('success','Country created successfully .');
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
    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $request->validate(['country_name' => 'required|unique:countries,country_name,' . $country->id]);
        $country->update($request->only('country_name'));
        return redirect()->route('countries.index')->with('success','Country updated Successfully. ');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries.index')->with('success','Country deleted successfully .');
    }
}
