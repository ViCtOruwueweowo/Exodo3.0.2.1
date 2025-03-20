<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Film;
use App\Models\Actor;
use App\Models\Language;
use App\Models\Inventory;
use App\Models\Rental;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index()
    {
        $categoriesCount = Category::count();
        $filmsCount = Film::count();
        $actorsCount = Actor::count();
        $languagesCount = Language::count();
        $inventoryCount = Inventory::count();

        // Obtener las películas más rentadas
        $rentalData = Rental::join('inventory', 'rental.inventory_id', '=', 'inventory.inventory_id')
            ->join('film', 'inventory.film_id', '=', 'film.film_id')
            ->selectRaw('film.title, COUNT(rental.rental_id) as total_rentals')
            ->groupBy('film.film_id', 'film.title')
            ->orderByDesc('total_rentals')
            ->limit(10) // Mostrar las 10 películas más rentadas
            ->get();

        $rentalTitles = $rentalData->pluck('title');
        $rentalCounts = $rentalData->pluck('total_rentals');

        return view('home', compact(
            'categoriesCount', 'filmsCount', 'actorsCount', 'languagesCount', 'inventoryCount',
            'rentalTitles', 'rentalCounts'
        ));
    }
}
