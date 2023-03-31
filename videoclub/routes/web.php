<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::group(['middleware' => ['cors']], function () {
  Route::resource('generos', 'GenreController');
});

Route::resource('peliculas', 'MovieController'); //->middleware('client');

Route::resource('resenas', 'ReviewController')->middleware('client');

Route::resource('usuarios', 'UserController');

Route::resource('alquiler', 'RentController')->middleware('client');

Route::post('peliculas/{id}/add-genre', 'MovieController@addGenre')->name('peliculas.addGenre');

Route::delete('peliculas/{id}/delete-genre', 'MovieController@deleteGenre')->name('peliculas.deleteGenre');
