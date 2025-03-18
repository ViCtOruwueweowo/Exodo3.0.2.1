<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // Muestra la lista de direcciones con la ciudad relacionada
    public function index()
    {
        $addresses = Address::join('city', 'address.city_id', '=', 'city.city_id')
                             ->select(
                                 'address.address_id',
                                 'address.address',
                                 'address.address2',
                                 'address.district',
                                 'city.city as city_name', // Alias para evitar conflictos de nombres
                                 'address.postal_code',
                                 'address.phone'
                             )
                             ->get();

        return view('address.index', compact('addresses'));
    }

    // Muestra el formulario para crear una nueva dirección
    public function create()
    {
        // Obtener todas las ciudades para seleccionar en el formulario
        $cities = City::all();
        return view('address.create', compact('cities'));
    }

    // Almacena una nueva dirección en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255', // Permitir valores nulos
            'district' => 'required|string|max:255',
            'city_id' => 'required|exists:city,city_id',
            'postal_code' => 'required|string|max:10',
            'phone' => 'nullable|string|max:15', // Cambié 'required' por 'nullable'
        ]);

        Address::create([
            'address' => $validated['address'],
            'address2' => $validated['address2'], // Agregué este valor
            'district' => $validated['district'],
            'city_id' => $validated['city_id'],
            'postal_code' => $validated['postal_code'],
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('address.index')->with('success', 'Dirección creada exitosamente.');
    }

    // Muestra el formulario para editar una dirección existente
    public function edit($addressId)
    {
        $address = Address::findOrFail($addressId);
        $cities = City::all(); // Obtener todas las ciudades para seleccionar en el formulario
        return view('address.edit', compact('address', 'cities'));
    }

    // Actualiza una dirección en la base de datos
    public function update(Request $request, $addressId)
    {
        // Validación de los datos
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255', // Permitir valores nulos
            'district' => 'required|string|max:255',
            'city_id' => 'required|exists:city,city_id',
            'postal_code' => 'required|string|max:10',
            'phone' => 'nullable|string|max:15', // Mantener como nullable
        ]);

        $address = Address::findOrFail($addressId);
        $address->update([
            'address' => $validated['address'],
            'address2' => $validated['address2'], // Actualizar el campo address2
            'district' => $validated['district'],
            'city_id' => $validated['city_id'],
            'postal_code' => $validated['postal_code'],
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('address.index')->with('success', 'Dirección actualizada exitosamente.');
    }

    // Elimina una dirección de la base de datos
    public function destroy($addressId)
    {
        $address = Address::findOrFail($addressId);
        $address->delete();

        return redirect()->route('address.index')->with('success', 'Dirección eliminada exitosamente.');
    }
}
