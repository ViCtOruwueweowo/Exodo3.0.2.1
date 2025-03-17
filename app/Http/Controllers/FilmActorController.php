<?php

namespace App\Http\Controllers;

use App\Models\FilmActor;
use Illuminate\Http\Request;

class FilmActorController extends Controller
{
    public function index()
    {
        $filmActors = FilmActor::all();
        return view('film_actors.index', compact('filmActors'));
    }
}
