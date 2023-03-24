<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\User;
use App\Models\Free;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class RentController extends BaseController
{

    //listar todos los elementos de la tabla rents
    public function index(){
        $rents = Rent::all();
        return response()->json($rents);
    }

    //Para ver un listado de las películas alquiladas por un usuario
    public function show() {
        $user = Auth::user();
        $user->rents->all();
        return response()->json($user);
    }

    //crear un alquiler con datos de usuario, película y añadiendo una fecha de expiración
    public function store(Request $request) {
        $user = Auth::user();
        if($user->role === 'free'){
            $validator = Validator::make($request->all(), [
                'movie_id' => 'required',
                'date' => 'required|date|date_format:Y-m-d'
            ]);

            if($validator->fails()){
                return $this->sendError('Error de validación. ', $validator->errors());
            }

            $rent = $user->rents()->attach([
                $request->input('movie_id') => ['expiration_date' => Carbon::parse($request->input('date'))->addDays(15)]
            ]);

            return $this->sendResponse($rent, 'Alquiler creado');
        }
        else{
            return $this->sendError('No tienes permiso para alquilar esta película.');
        }
    }

    //modificar un alquiler
    public function update(Request $request, $id) {
        $user = Auth::user();
        $rent = Rent::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'movie_id' => 'required',
            'expiration_date' => 'required|date|date_format:Y-m-d'
        ]);

        if($validator->fails()) {
            return $this->sendError('Error de validación. ', $validator->errors());
        }

        $rent->movie_id = $request->movie_id;
        $rent->expiration_date = Carbon::parse($request->input('expiration_date'))->addDays(15);
        $rent->save();

        return $this->sendResponse($rent, 'Alquiler modificado');
    }

    //eliminar un alquiler
    public function destroy($id) {
        $rent = Rent::findOrFail($id);
        $rent->delete();
    }
}
