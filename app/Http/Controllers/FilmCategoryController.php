<?php

namespace App\Http\Controllers;

use App\Models\FilmCategory;
use Illuminate\Http\Request;

class FilmCategoryController extends Controller
{ 
    public function index()
    { 
        $filmCategories = FilmCategory::with(['film', 'category'])->paginate(10);
    
        return view('film_categories.index', compact('filmCategories'));
    }
}
