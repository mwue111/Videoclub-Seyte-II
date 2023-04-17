<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetRequestController extends Controller
{
  //
  public function sendPasswordResetEmail(Request $request)
  {
    if (!$this->validEmail($request->email)) {
      return response()->json([
        'message' => 'Email no existe'
      ], Response::HTTP_NOT_FOUND);
    } else {
      $this->sendMail($request->email);
      return response()->json([
        'message' => 'Se ha enviado un correo para restablecer la contraseña'
      ], Response::HTTP_OK);
    }
  }

  public function sendMail($email)
  {
    $token = $this->generateToken($email);
    Mail::to($email)->send(new SendMail($token));
  }

  public function validEmail($email)
  {
    return !!User::where('email', $email)->first();
  }

  public function generateToken($email)
  {
    $isOtherToken = DB::table('password_reset_tokens')->where('email', $email)->first();
    if ($isOtherToken) {
      return $isOtherToken->token;
    }
    $token = Str::random(80);
    $this->storeToken($token, $email);
    return $token;
  }

  public function storeToken($token, $email)
  {
    DB::table('password_reset_tokens')->insert([
      'email' => $email,
      'token' => $token,
      'created_at' => Carbon::now(),
    ]);
  }
}
