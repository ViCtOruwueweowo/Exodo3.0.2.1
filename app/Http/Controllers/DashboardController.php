<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Film;
use App\Models\FilmActor;
use App\Models\FilmCategory;
use App\Models\FilmText;
use App\Models\Inventory;
use App\Models\Language;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Staff;
use App\Models\Store;


class DashboardController extends Controller
{
    public function index()
    {
        // Example queries
        $totalFilms = Film::count();
        $totalCustomers = Customer::count();
        $totalRentals = Rental::count();
        $totalPayments = Payment::sum('amount');
        $totalActors = Actor::count();
        $totalCategories = Category::count();
        $totalStores = Store::count();
        $totalStaff = Staff::count();

        // Pass data to the view
        return view('home', compact(
            'totalFilms', 
            'totalCustomers', 
            'totalRentals', 
            'totalPayments',
            'totalActors',
            'totalCategories',
            'totalStores',
            'totalStaff'
        ));
    }
}
