<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Staff;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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

        try {
            Store::create([
                'manager_staff_id' => $validated['manager_staff_id'],
                'address_id' => $validated['address_id'],
                'last_update' => now(),
            ]);

            return redirect()->route('store.index')->with('success', 'Store created successfully.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('store.index')->with('error', 'No se puede tener a 1 empleado en más de 1 tienda a la vez.');
            }

            throw $e;
        }
    }

    public function destroy($storeId)
    {
        try {
            $store = Store::findOrFail($storeId);
            $store->delete();
    
            return redirect()->route('store.index')->with('success', 'Store deleted successfully.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('store.index')->with('error', 'No se puede eliminar, otro registro interfiere con el proceso.');
            }
    
            throw $e;
        }
    }
}
