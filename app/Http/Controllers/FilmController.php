<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Language;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    // Muestra la lista de films con la información relacionada
    public function index()
    {
        $films = Film::join('language', 'film.language_id', '=', 'language.language_id')
            ->select(
                'film.film_id',
                'film.title',
                'film.description',
                'film.release_year',
                'language.name as language_name',
                'film.rental_duration',
                'film.rental_rate',
                'film.length',
                'film.replacement_cost',
                'film.rating',
                'film.special_features'
            )->paginate(10);

        return view('films.index', compact('films'));
    }

    // Muestra el formulario para crear un nuevo film
    public function create()
    {
        // Obtener todos los idiomas disponibles para seleccionar en el formulario
        $languages = Language::all();
        return view('films.create', compact('languages'));
    }

    // Almacena un nuevo film en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'required|integer|digits:4',
            'language_id' => 'required|exists:language,language_id',
            'rental_duration' => 'required|integer',
            'rental_rate' => 'required|numeric',
            'length' => 'required|integer',
            'replacement_cost' => 'required|numeric',
            'rating' => 'nullable|string|max:10',
            'special_features' => 'nullable|string|max:255',
        ]);

        Film::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'release_year' => $validated['release_year'],
            'language_id' => $validated['language_id'],
            'rental_duration' => $validated['rental_duration'],
            'rental_rate' => $validated['rental_rate'],
            'length' => $validated['length'],
            'replacement_cost' => $validated['replacement_cost'],
            'rating' => $validated['rating'],
            'special_features' => $validated['special_features'],
        ]);

        return redirect()->route('films.index')->with('success', 'Película creada exitosamente.');
    }

    // Muestra el formulario para editar un film existente
    public function edit($filmId)
    {
        $film = Film::findOrFail($filmId);
        $languages = Language::all(); // Obtener todos los idiomas disponibles
        return view('films.edit', compact('film', 'languages'));
    }

    // Actualiza un film en la base de datos
    public function update(Request $request, $filmId)
    {
        // Validación de los datos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'required|integer|digits:4',
            'language_id' => 'required|exists:language,language_id',
            'rental_duration' => 'required|integer',
            'rental_rate' => 'required|numeric',
            'length' => 'required|integer',
            'replacement_cost' => 'required|numeric',
            'rating' => 'nullable|string|max:10',
            'special_features' => 'nullable|string|max:255',
        ]);

        $film = Film::findOrFail($filmId);
        $film->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'release_year' => $validated['release_year'],
            'language_id' => $validated['language_id'],
            'rental_duration' => $validated['rental_duration'],
            'rental_rate' => $validated['rental_rate'],
            'length' => $validated['length'],
            'replacement_cost' => $validated['replacement_cost'],
            'rating' => $validated['rating'],
            'special_features' => $validated['special_features'],
        ]);

        return redirect()->route('films.index')->with('success', 'Película actualizada exitosamente.');
    }

    // Elimina un film de la base de datos
    public function destroy($filmId)
    {
        $film = Film::findOrFail($filmId);
        $film->delete();

        return redirect()->route('films.index')->with('success', 'Película eliminada exitosamente.');
    }
}
