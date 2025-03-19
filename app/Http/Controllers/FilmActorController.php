<?php

namespace App\Http\Controllers;

use App\Models\FilmActor;
use Illuminate\Http\Request;
use DB;


class FilmActorController extends Controller
{
    public function index()
    {
        $filmActors = DB::table('actor as a')
        ->join('film_actor as fa', 'a.actor_id', '=', 'fa.actor_id')
        ->join('film as f', 'fa.film_id', '=', 'f.film_id')
        ->select('a.first_name as Nombre', 'a.last_name as Apellido', 'f.title as Pelicula', 'fa.actor_id', 'fa.film_id', 'fa.last_update')
        ->get();

        // Pasar la variable $filmActors a la vista
        return view('film_actors.index', compact('filmActors'));
    }
}
