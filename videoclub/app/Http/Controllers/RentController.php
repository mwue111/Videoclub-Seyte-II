<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\User;
use App\Models\Free;

class RentController extends Controller
{

    //Para ver un listado de las películas alquiladas por un usuario
    public function index($id) {
        $user = User::findOrFail($id);

        $movies = Movie::whereHas('rents', function($query) use ($id) {
            $query->where('user_id', $id);
        })->get();

        //vista en blade provisional
        return view('rents.index', ['movies' => $movies]);
    }
}
