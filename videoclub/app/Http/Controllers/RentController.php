<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\User;
use App\Models\Free;
use App\Models\Premium;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use DB;

class RentController extends BaseController
{


    public function index(){
        if(Auth::user()->role === 'admin'){
            $response = Rent::all();
        }
        else{
            $response = 'No tienes permiso para estar aquí.';
        }
        return response()->json($response);
    }

    public function show(Request $request) {
        $user = Auth::user();

        if($user->role === 'premium'){
            $premium = $user->premium;
            $response = $premium->movies->all();
        }
        else if($user->role === 'free'){
            $response = $user->rents->all();
        }
        else{
            $path = $request->path();
            $userId = substr($path, 13, 3);
            $checkUser = User::find($userId);

            if($checkUser->role === 'free'){
                $response = $checkUser->rents->all();
            }
            if($checkUser->role === 'premium'){
                $response = "usuario premium";
            }
            else{
                $response = "Usuario admin";
            }
        }

        return response()->json($response);
    }

    //crear un alquiler con datos de usuario, película y añadiendo una fecha de expiración
    public function store(Request $request) {
        $user = Auth::user();

        if($user->role === 'free' || $user->role === 'admin'){
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
        else if($user->role === 'premium'){
            $validator = Validator::make($request->all(), [
                'movie_id' => 'required'
            ]);

            if($validator->fails()){
                return $this->sendError('Error de validación. ', $validator->errors());
            }

            $premium = $user->premium;

            $view = $premium->movies()->attach($request->input('movie_id'), ['user_id' => $premium->user_id]);


            return $this->sendResponse($view, 'Vista creada');
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
