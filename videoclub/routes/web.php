<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
// use App\Http\Controllers\API\ProductController;

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

Route::get('/', 'MovieController@index');

//registro de admins:
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'register'])->middleware('guest');

Route::post('logout', [RegisterController::class, 'logout']);
// Route::get('/', 'AdminController@loginForm');
// Route::post('login', [RegisterController::class, 'login'])->name('admin.login');
// Route::middleware('auth:api')->post('logout', [RegisterController::class, 'logout'])->name('admin.logout');


Route::resource('peliculas', 'MovieController'); //->middleware('client');
Route::resource('generos', 'GenreController'); //->name('generos.index');

Route::post('peliculas/{id}/add-genre', 'MovieController@addGenre')->name('peliculas.addGenre');

Route::delete('peliculas/{id}/delete-genre', 'MovieController@deleteGenre')->name('peliculas.deleteGenre');

Route::resource('resenas', 'ReviewController');//->middleware('client');

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
