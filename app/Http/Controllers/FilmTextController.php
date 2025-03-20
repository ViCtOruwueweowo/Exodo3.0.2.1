<?php

namespace App\Http\Controllers;

use App\Models\FilmText;
use App\Models\Film;

use Illuminate\Http\Request;

class FilmTextController extends Controller
{
    // Mostrar todos los registros
    public function index()
    {
        $films = FilmText::all();
        return response()->json($films);
    }

    public function showAllFilms()
    {
        // Obtener todos los registros de la tabla 'film_text'
        $films = FilmText::paginate(10); // Esto paginará los resultados mostrando 10 por página

        return view('films_text.index', compact('films'));
    }


    // Crear un nuevo registro
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $film = FilmText::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($film, 201);
    }

    // Actualizar un registro existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $film = FilmText::find($id);

        if (!$film) {
            return response()->json(['message' => 'Film not found'], 404);
        }

        $film->title = $request->title;
        $film->description = $request->description;
        $film->save();

        return response()->json($film);
    }

    // Eliminar un registro
    public function destroy($id)
    {
        // Buscar la película por su ID
        $film = Film::find($id);

        // Verificar si se encontró el film
        if (!$film) {
            return redirect()->route('films.show')->with('error', 'Película no encontrada');
        }

        // Eliminar el registro
        //$film->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('films.show')->with('success', 'Película eliminada correctamente');
    }
}