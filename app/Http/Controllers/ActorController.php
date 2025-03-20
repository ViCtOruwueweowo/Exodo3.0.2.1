<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::paginate(10);
        return view('actors.index', compact('actors'));
    }

    public function create()
    {
        return view('actors.create');
    }

    // Guardar un nuevo actor en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
        ]);

        // Crear el actor en la base de datos
        Actor::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'last_update' => now(), // Establecer el valor de last_update
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('actors.index')->with('success', 'Actor creado exitosamente.');
    }

    public function edit($actorId)
    {
        // Obtener el actor a editar por su ID
        $actor = Actor::findOrFail($actorId);

        // Pasar el actor a la vista de edición
        return view('actors.edit', compact('actor'));
    }

    // Actualizar el actor en la base de datos
    public function update(Request $request, $actorId)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
        ]);

        // Obtener el actor y actualizarlo
        $actor = Actor::findOrFail($actorId);
        $actor->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'last_update' => now(), // Actualizar el valor de last_update
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('actors.index')->with('success', 'Actor actualizado exitosamente.');
    }

    public function destroy($actorId)
    {
        // Obtener el actor a eliminar por su ID
        $actor = Actor::findOrFail($actorId);

        // Eliminar el actor
        $actor->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('actors.index')->with('success', 'Actor eliminado exitosamente.');
    }

}
