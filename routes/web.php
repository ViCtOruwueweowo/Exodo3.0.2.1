<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActorController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmActorController;
use App\Http\Controllers\FilmCategoryController;
use App\Http\Controllers\LanguageController;
use App\Models\Film;
use App\Http\Controllers\FilmTextController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\RentalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('/countries/create', [CountryController::class, 'create'])->name('countries.create');
Route::post('/countries', [CountryController::class, 'store'])->name('countries.store');
Route::get('/countries/{country}/edit', [CountryController::class, 'edit'])->name('countries.edit');
Route::put('/countries/{country}', [CountryController::class, 'update'])->name('countries.update');
Route::delete('/countries/{country}', [CountryController::class, 'destroy'])->name('countries.destroy');

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
Route::get('/cities/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
Route::put('/cities/{city}', [CityController::class, 'update'])->name('cities.update');
Route::delete('/cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');

Route::get('/address', [AddressController::class, 'index'])->name('address.index');
Route::get('/address/create', [AddressController::class, 'create'])->name('address.create');
Route::post('/address', [AddressController::class, 'store'])->name('address.store');
Route::get('/address/{address}/edit', [AddressController::class, 'edit'])->name('address.edit');
Route::put('/address/{address}', [AddressController::class, 'update'])->name('address.update');
Route::delete('/address/{address}', [AddressController::class, 'destroy'])->name('address.destroy');

Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');
Route::get('/languages/create', [LanguageController::class, 'create'])->name('languages.create');
Route::post('/languages', [LanguageController::class, 'store'])->name('languages.store');
Route::get('/languages/{language}/edit', [LanguageController::class, 'edit'])->name('languages.edit');
Route::put('/languages/{language}', [LanguageController::class, 'update'])->name('languages.update');
Route::delete('/languages/{language}', [LanguageController::class, 'destroy'])->name('languages.destroy');


Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/create', [ActorController::class, 'create'])->name('actors.create');
Route::post('/actors', [ActorController::class, 'store'])->name('actors.store');
Route::get('/actors/{actor}/edit', [ActorController::class, 'edit'])->name('actors.edit');
Route::put('/actors/{actor}', [ActorController::class, 'update'])->name('actors.update');
Route::delete('/actors/{actor}', [ActorController::class, 'destroy'])->name('actors.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/films', [FilmController::class, 'store'])->name('films.store');
Route::get('/films/{category}/edit', [FilmController::class, 'edit'])->name('films.edit');
Route::put('/films/{category}', [FilmController::class, 'update'])->name('films.update');
Route::delete('/films/{category}', [FilmController::class, 'destroy'])->name('films.destroy');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/film-actors', [FilmActorController::class, 'index'])->name('film_actors.index');
Route::get('/film-categories', [FilmCategoryController::class, 'index'])->name('film_categories.index');

Route::get('films/show', [FilmTextController::class, 'showAllFilms'])->name('films.show');

Route::get('inventory', [InventoryController::class, 'showAllInventory'])->name('inventarios.show');
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventario.create');
Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{inventory_id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('/inventory/{inventory_id}', [InventoryController::class, 'update'])->name('inventory.update');
Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventarios.destroy');


Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
Route::post('/store', [StoreController::class, 'store'])->name('store.store');
Route::get('/store/{store}/edit', [StoreController::class, 'edit'])->name('store.edit');
Route::put('/store/{store}', [StoreController::class, 'update'])->name('store.update');
Route::delete('/store/{store}', [StoreController::class, 'destroy'])->name('store.destroy');

Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/{staff}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/staff/{staff}', [StaffController::class, 'update'])->name('staff.update');
Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');

Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::get('/rentals/create', [RentalController::class, 'create'])->name('rentals.create');
Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
Route::get('/rentals/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
Route::put('/rentals/{rental}', [RentalController::class, 'update'])->name('rentals.update');
Route::delete('/rentals/{rental}', [RentalController::class, 'destroy'])->name('rentals.destroy');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');       
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create'); 
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');        
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');  
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit'); 
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update'); 
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy'); 