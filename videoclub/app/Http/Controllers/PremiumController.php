<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Premium;
use App\Models\Free;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
    $validator = Validator::make($request->all(), [
        'user_id' => 'required | numeric',
    ]);

    if($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    $user = User::findOrFail($request->user_id);

    if($user){
        $premium = Premium::create(['user_id' => $request->user_id, 'payment_date' => now()]);
        $user->role = 'premium';
        $user->free->delete();

        $user->save();
    }

    return response()->json($user);
  }

  public function checkPremium() {
    $user = Auth::user();
    if($user->role === 'premium'){
        if($user->premium->payment_date > Carbon::now()){
            //expirado
            $free = Free::create(['user_id' => $user->id]);
            $user->role = 'free';
            $user->premium->delete();
            $user->save();
          }
          else{
            $date = Carbon::parse($user->premium->payment_date);
            $now = Carbon::now(); //->addDays(6);
            $diff = $date->diffInDays($now);
            // dd($diff);   //359

            if($diff >= 358){
                switch($diff){
                    case 358: $response = [7]; break;
                    case 359: $response = [6]; break;
                    case 360: $response = [5]; break;
                    case 361: $response = [4]; break;
                    case 362: $response = [3]; break;
                    case 363: $response = [2]; break;
                    case 364: $response = ['mañana']; break;
                }
                return response()->json($response);
            }
        }
    }

    return response()->json($user);
  }

  public function cancelSub() {
    $user = Auth::user();

    if($user){
        $free = Free::create(['user_id' => $user->id]);
        $user->role = 'free';
        $user->premium->delete();
        $user->save();
    }

    return response()->json($user);
  }
}
