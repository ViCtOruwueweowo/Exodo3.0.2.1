<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        return view('staffs.index', compact('staffs'));
    }

    public function create()
    {
        return view('staff.create');
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
        $staff->password = bcrypt($validated['password']);
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
        return view('staff.edit', compact('staff'));
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
        $staff->password = bcrypt($validated['password']);
        $staff->last_update = now();

        if ($request->hasFile('picture')) {
            $staff->picture = $request->file('picture')->store('staff');
        }

        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy($staffId)
    {
        $staff = Staff::findOrFail($staffId);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }
}
