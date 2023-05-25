<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;    //rents
use App\Models\Free;
use App\Models\Premium; //views
use Illuminate\Support\Facades\Auth;

class UserViewController extends Controller
{
    public function index(){
        $rents = Auth::user()->rents;
        return response()->json($rents);
    }

    public function show($id){
        //traer todos los comentarios hechos por el usuario autenticado
        $user = User::findOrFail($id);
        if($user->id === Auth::user()->id){
            $reviews = $user->reviews;
            dd($reviews);
        }
    }
}
