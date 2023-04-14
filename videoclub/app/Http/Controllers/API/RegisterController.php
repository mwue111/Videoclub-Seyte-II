<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Admin;
use App\Models\Free;
use App\Models\Premium;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
  /**
   * Register api
   *
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'birth_date' => 'required',
      'password' => 'required',
      'c_password' => 'required|same:password',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }
    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $user->role = 'free';
    $user->save();
    switch ($user->role) {
      case 'admin':
        Admin::create(['user_id' => $user->id]);
        break;
      case 'free':
        Free::create(['user_id' => $user->id]);
        break;
      case 'premium':
        Premium::create(['user_id' => $user->id, 'fecha_ultimo_pago' => now()]);
        break;
    }

    $success['token'] =  $user->createToken('MyApp')->accessToken;
    $success['name'] =  $user->name;
    $user->save();
    return $this->sendResponse($success, 'Registro realizado con éxito.');
  }

  /**
   * Login api
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user();
      $success['token'] =  $user->createToken('MyApp')->accessToken;
      $success['user'] = [
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
      ];
      return $this->sendResponse($success, 'Has iniciado sesión.');
    } else {
      return $this->sendError('Unauthorised.', ['error' => 'Unauthorized']);
    }
  }

  public function profile()
  {
    return response()->json(Auth::user());
  }

  public function logout(Request $request)
  {
    $token = $request->user()->token();
    $token->revoke();
    return response(['message' => 'Has cerrado sesión.'], 200);
  }
}
