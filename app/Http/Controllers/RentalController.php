<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::all();
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        return view('rentals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rental_date' => 'required|date',
            'inventory_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'return_date' => 'nullable|date',
            'staff_id' => 'required|integer',
        ]);

        Rental::create([
            'rental_date' => $validated['rental_date'],
            'inventory_id' => $validated['inventory_id'],
            'customer_id' => $validated['customer_id'],
            'return_date' => $validated['return_date'],
            'staff_id' => $validated['staff_id'],
            'last_update' => now(), 
        ]);

        return redirect()->route('rentals.index')->with('success', 'Rental creado exitosamente.');
    }

    public function edit($rentalId)
    {
        $rental = Rental::findOrFail($rentalId);
        return view('rentals.edit', compact('rental'));
    }

    public function update(Request $request, $rentalId)
    {
        $validated = $request->validate([
            'rental_date' => 'required|date',
            'inventory_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'return_date' => 'nullable|date',
            'staff_id' => 'required|integer',
        ]);

        $rental = Rental::findOrFail($rentalId);
        $rental->update([
            'rental_date' => $validated['rental_date'],
            'inventory_id' => $validated['inventory_id'],
            'customer_id' => $validated['customer_id'],
            'return_date' => $validated['return_date'],
            'staff_id' => $validated['staff_id'],
            'last_update' => now(), 
        ]);

        return redirect()->route('rentals.index')->with('success', 'Rental actualizado exitosamente.');
    }

    public function destroy($rentalId)
    {
        $rental = Rental::findOrFail($rentalId);

        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Rental eliminado exitosamente.');
    }
}