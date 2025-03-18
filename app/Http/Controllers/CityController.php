<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::join('country', 'city.country_id', 'country.country_id')
                     ->select('city.city_id', 'city.city', 'country.country')
                     ->get();
    
        return view('cities.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|max:45',
            'country_id' => 'required|exists:country,country_id',
        ]);
        
        City::create([
            'city' => $validated['city'],
            'country_id' => $validated['country_id'],
            'last_update' => now(),
        ]);
        
        return redirect()->route('cities.index')->with('success', 'Ciudad creada exitosamente.');
    }

    public function edit($cityId)
    {
        $city = City::findOrFail($cityId);
        $countries = Country::all();
        return view('cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, $cityId)
    {
        $validated = $request->validate([
            'city' => 'required|max:45',
            'country_id' => 'required|exists:country,country_id',
        ]);

        $city = City::findOrFail($cityId);
        $city->update([
            'city' => $validated['city'],
            'country_id' => $validated['country_id'],
            'last_update' => now(),
        ]);

        return redirect()->route('cities.index')->with('success', 'Ciudad actualizada exitosamente.');
    }

    public function destroy($cityId)
    {
        $city = City::findOrFail($cityId);
        $city->delete();

        return redirect()->route('cities.index')->with('success', 'Ciudad eliminada exitosamente.');
    }
}
