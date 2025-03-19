<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Staff;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::join('staff', 'store.manager_staff_id', '=', 'staff.staff_id')
            ->join('address', 'store.address_id', '=', 'address.address_id')
            ->select(
                'store.store_id',
                DB::raw("CONCAT(staff.first_name, ' ', staff.last_name) as manager_staff"),
                'address.address as address_name',
            )
            ->get();
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        $staff = Staff::select(
            'staff_id',
            DB::raw("CONCAT(first_name, ' ', last_name) as full_name")
        )->get();

        $addresses = Address::select(
            'address_id',
            'address as address_name'
        )->get();

        $stores = Store::select(
            'store_id',
        )->get();

        return view('stores.create', compact('staff', 'addresses', 'stores'));
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
