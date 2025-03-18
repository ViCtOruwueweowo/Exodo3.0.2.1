<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('store.index', compact('stores'));
    }

    public function create()
    {
        return view('store.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'manager_staff_id' => 'required|integer',
            'address_id' => 'required|integer',
        ]);

        Store::create([
            'manager_staff_id' => $validated['manager_staff_id'],
            'address_id' => $validated['address_id'],
            'last_update' => now(),
        ]);

        return redirect()->route('store.index')->with('success', 'Store created successfully.');
    }

    public function edit($storeId)
    {
        $store = Store::findOrFail($storeId);
        //return view('store.edit', compact('store'));
    }

    public function update(Request $request, $storeId)
    {
        $validated = $request->validate([
            'manager_staff_id' => 'required|integer',
            'address_id' => 'required|integer',
        ]);

        $store = Store::findOrFail($storeId);
        $store->update([
            'manager_staff_id' => $validated['manager_staff_id'],
            'address_id' => $validated['address_id'],
            'last_update' => now(),
        ]);

        return redirect()->route('store.index')->with('success', 'Store updated successfully.');
    }

    public function destroy($storeId)
    {
        $store = Store::findOrFail($storeId);
        $store->delete();

        return redirect()->route('store.index')->with('success', 'Store deleted successfully.');
    }
}
