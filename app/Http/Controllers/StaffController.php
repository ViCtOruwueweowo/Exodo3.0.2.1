<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Database\QueryException;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::join('address', 'staff.address_id', '=', 'address.address_id')
            ->select(
                'staff.staff_id',
                'staff.first_name',
                'staff.last_name',
                'address.address as address_name',
                'staff.email',
                'staff.store_id',
                'staff.active',
                'staff.username',
                'staff.password',
                'staff.picture',
            )
            ->get();
        return view('staffs.index', compact('staffs'));
    }

    public function create()
    {
        $addresses = Address::select(
            'address_id',
            'address as address_name'
        )->get();

        $stores = Store::select(
            'store_id',
        )->get();
        
        return view('staffs.create', compact('addresses', 'stores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address_id' => 'required|integer',
            'picture' => 'nullable|image',
            'email' => 'required|email',
            'store_id' => 'required|integer',
            'active' => 'required|boolean',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $staff = new Staff();
        $staff->first_name = $validated['first_name'];
        $staff->last_name = $validated['last_name'];
        $staff->address_id = $validated['address_id'];
        $staff->email = $validated['email'];
        $staff->store_id = $validated['store_id'];
        $staff->active = $validated['active'];
        $staff->username = $validated['username'];
        $staff->password = $validated['password'];
        $staff->last_update = now();

        if ($request->hasFile('picture')) {
            $staff->picture = $request->file('picture')->store('staff');
        }

        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff created successfully.');
    }

    public function edit($staffId)
    {
        $staff = Staff::findOrFail($staffId);
        $addresses = Address::select('address_id', 'address as address_name')->get();
        $stores = Store::select('store_id')->get();

        return view('staffs.edit', compact('staff', 'addresses', 'stores'));
    }

    public function update(Request $request, $staffId)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address_id' => 'required|integer',
            'picture' => 'nullable|image',
            'email' => 'required|email',
            'store_id' => 'required|integer',
            'active' => 'required|boolean',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $staff = Staff::findOrFail($staffId);
        $staff->first_name = $validated['first_name'];
        $staff->last_name = $validated['last_name'];
        $staff->address_id = $validated['address_id'];
        $staff->email = $validated['email'];
        $staff->store_id = $validated['store_id'];
        $staff->active = $validated['active'];
        $staff->username = $validated['username'];
        $staff->password = $validated['password'];
        $staff->last_update = now();

        if ($request->hasFile('picture')) {
            $staff->picture = $request->file('picture')->store('staff');
        }

        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy($staffId)
    {
        try {
            $staff = Staff::findOrFail($staffId);
            $staff->delete();
    
            return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('staff.index')->with('error', 'No se puede eliminar, otro registro interfiere con el proceso.');
            }
    
            throw $e;
        }
    }
}
