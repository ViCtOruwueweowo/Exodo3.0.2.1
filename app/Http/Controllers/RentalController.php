<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Models\Customer;
use App\Models\Staff;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::join('inventory', 'rental.inventory_id', '=', 'inventory.inventory_id')
            ->join('customer', 'rental.customer_id', '=', 'customer.customer_id')
            ->join('staff', 'rental.staff_id', '=', 'staff.staff_id')
            ->select(
                'rental.rental_id',
                'rental.rental_date',
                'rental.inventory_id',
                DB::raw("CONCAT(customer.first_name, ' ', customer.last_name) as customer_name"),
                'rental.return_date',
                DB::raw("CONCAT(staff.first_name, ' ', staff.last_name) as staff_name"),
            )
            ->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $inventories = Inventory::select('inventory_id')->get();
        $customers = Customer::select('customer_id', 'first_name', 'last_name')->get();
        $staffs = Staff::select('staff_id', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))->get();

        return view('rentals.create', compact('inventories', 'customers', 'staffs'));
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

        return redirect()->route('rentals.index')->with('success', 'Rental created successfully.');
    }

    public function edit($rentalId)
    {
        $rental = Rental::findOrFail($rentalId);
        $inventories = Inventory::select('inventory_id')->get();
        $customers = Customer::select('customer_id', 'first_name', 'last_name')->get();
        $staffs = Staff::select('staff_id', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))->get();

        return view('rentals.edit', compact('rental', 'inventories', 'customers', 'staffs'));
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