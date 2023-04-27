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

// Route::get('/', 'MovieController@index');

// Route::post('admin/register', 'RegisterController@register');
// Route::post('admin/login', 'RegisterController@login');
Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('peliculas', 'MovieController');//->middleware('cors') //->middleware('client');
    Route::resource('generos', 'GenreController'); //->name('generos.index');
    Route::post('peliculas/{id}/add-genre', 'MovieController@addGenre')->name('peliculas.addGenre');

    Route::delete('peliculas/{id}/delete-genre', 'MovieController@deleteGenre')->name('peliculas.deleteGenre');

    Route::resource('resenas', 'ReviewController')->middleware('client');

    Route::resource('usuarios', 'UserController');

    Route::resource('alquiler', 'RentController'); //->middleware('client');

    //Buscador en el back:
    Route::get('buscar', 'SearchController@search')->name('movies.search');

    //Recuperación y eliminación de películas:
    Route::get('peliculas-eliminadas', 'MovieController@deleted')->name('movies.deleted');
    Route::post('restaurar-peliculas/{id}', 'MovieController@restore')->name('movies.restore');
    Route::delete('borrar-def-peliculas/{id}', 'MovieController@forceDelete')->name('movies.force-delete');

    //Recuperación y eliminación de géneros:
    Route::get('generos-liminados', 'GenreController@deleted')->name('genres.deleted');
    Route::post('restaurar-generos/{id}', 'GenreController@restore')->name('genres.restore');
    Route::delete('borrar-def-generos/{id}', 'GenreController@forceDelete')->name('genres.force-delete');

});
