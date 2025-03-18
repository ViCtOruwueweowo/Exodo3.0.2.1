<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Film;
use App\Models\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
 
     // Almacenar un nuevo inventario
     public function store(Request $request)
     {
         $request->validate([
             'film_id' => 'required|exists:films,film_id',
             'store_id' => 'required|exists:stores,store_id',
         ]);
 
         Inventory::create($request->all());
 
         return redirect()->route('inventory.index')->with('success', 'Inventario creado con éxito');
     }
 
     // Mostrar el formulario para editar un inventario existente
     public function edit($id)
     {
         $inventory = Inventory::findOrFail($id);
         $films = Film::all();
         $stores = Store::all();
         return view('inventory.edit', compact('inventory', 'films', 'stores'));
     }
 
     // Actualizar un inventario
     public function update(Request $request, $id)
     {
         $request->validate([
             'film_id' => 'required|exists:films,film_id',
             'store_id' => 'required|exists:stores,store_id',
         ]);
 
         $inventory = Inventory::findOrFail($id);
         $inventory->update($request->all());
 
         return redirect()->route('inventory.index')->with('success', 'Inventario actualizado con éxito');
     }
 
     // Eliminar un inventario
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventarios.show')->with('success', 'El elemento ah sido eliminado correctamente!.');
    }
}
