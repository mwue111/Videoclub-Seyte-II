<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Premium;
use App\Models\Free;
use Illuminate\Http\Request;
use Validator;

class PremiumController extends Controller
{
  public function index()
  {
    return Premium::all();
  }

  public function show($id)
  {
    $premium = Premium::findOrFail($id);
    return $premium->user;
  }

  public function store(Request $request) {
    //llegará id de usuario - user_id
    //fecha actual - current_date

    //validar
    $validator = Validator::make($request->all(), [
        'user_id' => 'required | numeric',
    ]);

    if($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    $user = User::findOrFail($request->user_id);

    if($user){
        $premium = Premium::create(['user_id' => $request->user_id, 'fecha_ultimo_pago' => now()]);
        $user->role = 'premium';
        $user->free->delete();
        $user->save();
    }

  }
}
