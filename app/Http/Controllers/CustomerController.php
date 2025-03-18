<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Store;
use App\Models\Address;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $customers = Customer::with(['store', 'address'])->get(); 
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $stores = Store::all();      
        $addresses = Address::all(); 
        return view('customers.create', compact('stores', 'addresses'));
    }

    // Almacenar un nuevo cliente
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'store_id' => 'required|exists:store,store_id',  
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
            'email' => 'nullable|email|max:50',
            'address_id' => 'required|exists:address,address_id', 
            'active' => 'required|boolean',
        ]);

        // Crear el cliente
        Customer::create([
            'store_id' => $request->store_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address_id' => $request->address_id,
            'active' => $request->active,
            'create_date' => now(), 
        ]);

        return redirect()->route('customers.index')
                         ->with('success', 'Customer created successfully.');
    }

    // Mostrar un cliente
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $stores = Store::all();
        $addresses = Address::all();

        return view('customers.edit', compact('customer', 'stores', 'addresses'));
    }

    // Actualizar un cliente
    public function update(Request $request, Customer $customer)
    {
        // Validación
        $request->validate([
            'store_id' => 'required|exists:store,store_id',
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
            'email' => 'nullable|email|max:50',
            'address_id' => 'required|exists:address,address_id',
            'active' => 'required|boolean',
        ]);

        // Actualizar los datos del cliente
        $customer->update([
            'store_id' => $request->store_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address_id' => $request->address_id,
            'active' => $request->active,
        ]);

        return redirect()->route('customers.index')
                         ->with('success', 'Customer updated successfully.');
    }

    // Eliminar un cliente
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
                         ->with('success', 'Customer deleted successfully.');
    }
}
