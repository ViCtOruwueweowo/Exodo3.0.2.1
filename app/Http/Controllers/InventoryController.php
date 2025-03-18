<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Film;
use App\Models\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;

class InventoryController extends Controller
{
     // Mostrar todos los inventarios
     public function index()
     {
         $inventories = Inventory::with(['film', 'store'])->get(); // Cargar datos relacionados con film y store
         return view('inventory.index', compact('inventories'));
     }

     public function showAllInventory()
     {
         // Obtener todos los registros de la tabla 
         $inventories = Inventory::all();

         // Obtener todos los inventarios con sus respectivas películas asociadas
         $inventories = Inventory::with('film')->get();

         $stores = Store::all(); // Obtener todas las tiendas
         // Retornar la vista y pasar los datos
         return view('inventory.index', compact('inventories'));
     }
 
 
     // Mostrar el formulario para crear un nuevo inventario
     public function create()
     {
         $films = Film::all();  // Obtener todas las películas
         $stores = Store::all(); // Obtener todas las tiendas
         return view('inventory.create', compact('films', 'stores'));
     }
 
     public function store(Request $request)
     {
         // Validación de los datos
         $request->validate([
             'film_id' => 'required|exists:film,film_id', // Verifica si el `film_id` existe en la tabla `films`
             'store_id' => 'required|exists:store,store_id', // Verifica si el `store_id` existe en la tabla `stores`
         ]);
         
         // Crear el nuevo inventario
         Inventory::create([
             'film_id' => $request->film_id, // Asignar el film_id
             'store_id' => $request->store_id, // Asignar el store_id
         ]);
 
         // Redirigir a la lista de inventarios con un mensaje de éxito
         return redirect()->route('inventarios.show')->with('success', 'Inventario creado con éxito');
     }
 
    // Mostrar el formulario de edición
    public function edit($inventory_id)
    {
        $inventory = Inventory::findOrFail($inventory_id); // Obtener el inventario por su ID
        $films = Film::all(); // Obtener todas las películas
        $stores = Store::all(); // Obtener todas las tiendas

        return view('inventory.edit', compact('inventory', 'films', 'stores'));
    }

 
     // Actualizar un inventario
     public function update(Request $request, $id)
     {
         $request->validate([
             'film_id' => 'required|exists:film,film_id',
             'store_id' => 'required|exists:store,store_id',
         ]);
 
         $inventory = Inventory::findOrFail($id);
         $inventory->update($request->all());
 
         return redirect()->route('inventarios.show')->with('success', 'Inventario creado con éxito');
     }
 
    // Eliminar un inventario
    public function destroy($inventory_id)
    {
        // Primero eliminamos los registros relacionados en la tabla rental
        Rental::where('inventory_id', $inventory_id)->delete();
        
        // Luego eliminamos el inventario
        $inventory = Inventory::findOrFail($inventory_id);
        $inventory->delete();

        // Redirigimos con un mensaje de éxito
        return redirect()->route('inventarios.show')->with('success', 'Inventario eliminado con éxito');
    }
}
