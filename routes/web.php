<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::get('/', function () {
    return redirect('/event');
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('event', EventController::class);
Route::middleware('can:isAdmin')->group(function() {
    Route::resource('artist', ArtistController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('venue', VenueController::class);
});