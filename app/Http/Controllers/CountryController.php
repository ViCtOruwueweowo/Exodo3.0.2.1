<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::paginate(10);
        return view('countries.index', compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|max:45',
        ]);
        
        Country::create([
            'country' => $validated['country'],
            'last_update' => now(),
        ]);
        
        return redirect()->route('countries.index')->with('success', 'País creado exitosamente.');
    }

    public function edit($countryId)
    {
        $country = Country::findOrFail($countryId);
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, $countryId)
    {
        $validated = $request->validate([
            'country' => 'required|max:45',
        ]);

        $country = Country::findOrFail($countryId);
        $country->update([
            'country' => $validated['country'],
            'last_update' => now(),
        ]);

        return redirect()->route('countries.index')->with('success', 'Continente actualizado exitosamente.');
    }

    public function destroy($countryId)
    {
        $country = Country::findOrFail($countryId);
        $country->delete();

        return redirect()->route('countries.index')->with('success', 'Continente eliminado exitosamente.');
    }
}
