<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmActorController;
use App\Http\Controllers\FilmCategoryController;




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


Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/film-actors', [FilmActorController::class, 'index'])->name('film_actors.index');
Route::get('/film-categories', [FilmCategoryController::class, 'index'])->name('film_categories.index');
