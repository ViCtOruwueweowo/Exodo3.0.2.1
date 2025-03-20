<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::paginate(10);  // Obtiene todos los idiomas
        return view('languages.index', compact('languages')); // Devuelve la vista con los idiomas
    }

    public function create()
    {
        return view('languages.create'); // Devuelve la vista para crear un nuevo idioma
    }

    public function store(Request $request)
    {
        // Valida que el nombre del idioma sea obligatorio y no exceda los 45 caracteres
        $validated = $request->validate([
            'name' => 'required|max:45',
        ]);
        
        // Crea un nuevo idioma con los datos validados
        Language::create([
            'name' => $validated['name'],
            'last_update' => now(), // Actualiza la fecha de creación
        ]);
        
        // Redirige a la lista de idiomas con un mensaje de éxito
        return redirect()->route('languages.index')->with('success', 'Idioma creado exitosamente.');
    }

    public function edit($languageId)
    {
        // Encuentra el idioma por ID o lanza un error si no se encuentra
        $language = Language::findOrFail($languageId);
        return view('languages.edit', compact('language')); // Devuelve la vista para editar el idioma
    }

    public function update(Request $request, $languageId)
    {
        // Valida que el nombre del idioma sea obligatorio y no exceda los 45 caracteres
        $validated = $request->validate([
            'name' => 'required|max:45',
        ]);

        // Encuentra el idioma por ID o lanza un error si no se encuentra
        $language = Language::findOrFail($languageId);
        // Actualiza los datos del idioma
        $language->update([
            'name' => $validated['name'],
            'last_update' => now(), // Actualiza la fecha de modificación
        ]);

        // Redirige a la lista de idiomas con un mensaje de éxito
        return redirect()->route('languages.index')->with('success', 'Idioma actualizado exitosamente.');
    }

    public function destroy($languageId)
    {
        // Encuentra el idioma por ID o lanza un error si no se encuentra
        $language = Language::findOrFail($languageId);
        // Elimina el idioma
        $language->delete();

        // Redirige a la lista de idiomas con un mensaje de éxito
        return redirect()->route('languages.index')->with('success', 'Idioma eliminado exitosamente.');
    }
}
