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

// Route::get('/', function () {
//   return view('welcome');
// });

Route::get('/', 'MovieController@index');

Route::resource('peliculas', 'MovieController'); //->middleware('client');
Route::resource('generos', 'GenreController'); //->name('generos.index');

Route::post('peliculas/{id}/add-genre', 'MovieController@addGenre')->name('peliculas.addGenre');

Route::delete('peliculas/{id}/delete-genre', 'MovieController@deleteGenre')->name('peliculas.deleteGenre');

Route::resource('resenas', 'ReviewController')->middleware('client');

Route::resource('usuarios', 'UserController');

Route::resource('alquiler', 'RentController'); //->middleware('client');

Route::get('buscar', 'SearchController@search')->name('movies.search');

Route::get('eliminadas', 'MovieController@deleted')->name('movies.deleted');
Route::get('restaurar', 'MovieController@restore')->name('movies.restore');
