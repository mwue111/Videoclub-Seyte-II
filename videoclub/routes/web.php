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

Route::get('/welcome', 'AdminController@welcome')->name('welcome')->middleware('auth', 'admin');
Route::get('/', 'AdminController@loginForm'); //->middleware('guest');

Route::group(['middleware' => ['guest']], function () {
    //registro de admins:
    Route::get('register', [RegisterController::class, 'create']);
    Route::post('register', [RegisterController::class, 'register']);

    //login:
    Route::get('login', 'AdminController@loginForm');
    Route::post('login', [RegisterController::class, 'login'])->name('admin.login');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('peliculas', 'MovieController');
    Route::resource('generos', 'GenreController');
    Route::resource('usuarios', 'UserController');
    Route::post('peliculas/{id}/add-genre', 'MovieController@addGenre')->name('peliculas.addGenre');
    Route::delete('peliculas/{id}/delete-genre', 'MovieController@deleteGenre')->name('peliculas.deleteGenre');
    Route::resource('resenas', 'ReviewController');
    Route::resource('usuarios', 'UserController');
    Route::resource('alquiler', 'RentController');

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

    //Recuperación de usuarios
    Route::get('usuarios-eliminados', 'UserController@deleted')->name('users.deleted');
    Route::post('restaurar-usuario/{id}', 'UserController@restore')->name('users.restore');
    Route::delete('borrar-def-usuario/{id}', 'UserController@forceDelete')->name('users.force-delete');

    //logout:
    Route::post('logout', [RegisterController::class, 'logout']);
});


