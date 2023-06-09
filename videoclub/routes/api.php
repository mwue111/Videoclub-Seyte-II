<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\GenreController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::group(['middleware' => ['guest']], function () {
    Route::post('premium', 'PremiumController@store');
    Route::get('autor-resena/{id}', 'ReviewController@getAuthor');
    Route::get('resenas', 'ReviewController@index');
    Route::post('resenas', 'ReviewController@store');
    Route::put('resenas/{id}', 'ReviewController@update');
    Route::delete('resenas/{id}', 'ReviewController@destroy');
    Route::get('resenas/pelicula/{id}/{page}', 'ReviewController@getReviews');
    Route::get('todas-las-peliculas', 'MovieController@getAllMovies');
    Route::get('peliculas', 'MovieController@index')->name('peliculas.index');
    Route::get('peliculas/{id}', 'MovieController@show')->name('peliculas.index');
    Route::get('generos', 'GenreController@index')->name('generos.index');
    Route::get('pelicula/{id}/generos', 'GenreController@getGenres')->name('generos.getMovies');
    Route::get('generos/{id}/peliculas', 'GenreController@getMovies')->name('generos.getMovies');
    Route::post('/reset-password', 'PasswordResetRequestController@sendPasswordResetEmail');
    Route::post('/change-password', 'ChangePasswordController@passwordResetProcess');
    Route::get('/check-password', [RegisterController::class, 'oldPassword']);
    Route::get('/resultado', 'SearchController@frontSearch');
});

Route::group(['middleware' => ['auth:api', 'cors']], function () {
//   Route::resource('resenas', ReviewController::class);
    Route::resource('usuarios', 'UserController');  //dividir en rutas
    Route::get('peliculas-vistas', 'UserViewController@index');
    Route::get('peliculas-alquiladas', 'RentController@index');
    Route::get('comprobar-alquiler', 'RentController@checkExpirationDate');
    Route::get('comprobar-premium', 'PremiumController@checkPremium');
    Route::get('resenas-hechas/{id}/{page}', 'UserViewController@show');
    Route::post('nueva-vista/{id}', 'UserViewController@store');
    Route::post('nuevo-alquiler', 'RentController@store');
    Route::post('usuario-avatar/{usuario}', 'UserImageController@updateWithFormData');
    Route::get('resena/{resena}/pelicula', 'ReviewController@show');
    Route::post('/update-password', 'ChangePasswordController@updatePassword');
    Route::get('resenas', 'ReviewController@index');
    Route::resource('alquiler', RentController::class);
    Route::get('profile', [RegisterController::class, 'profile']);
    Route::post('cancelar-sub', 'PremiumController@cancelSub');
});

Route::middleware('auth:api')->post('logout', [RegisterController::class, 'logout']);
