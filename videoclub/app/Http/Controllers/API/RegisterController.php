<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Admin;
use App\Models\Free;
use App\Models\Premium;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Validator;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use Hash;

class RegisterController extends BaseController
{

    public function create() {
        return view('register.create');
    }

  /**
   * Register api
   *
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:users,email',
      'birth_date' => 'required',
      'password' => 'required|min:7|max:255',
      'c_password' => 'required|same:password',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);    //esto se puede hacer con un mutador en el modelo de usuario
    // $user = User::create($input);
    $user = new User($input);

    if($request->path() === 'api/register'){
        $user->role = 'free';
    }
    else{
        $user->role = 'admin';
    }
    $user->save();

    switch ($user->role) {
      case 'admin':
        Admin::create(['user_id' => $user->id]);
        break;
      case 'free':
        Free::create(['user_id' => $user->id]);
        break;
      case 'premium':
        Premium::create(['user_id' => $user->id, 'payment_date' => now()]);
        break;
    }

    $success['token'] =  $user->createToken('MyApp')->accessToken;
    $success['name'] =  $user->name;
    $user->save();

    if($request->path() === 'api/register') {
        return $this->sendResponse($success, 'Registro realizado con éxito.');
    }
    else{
        Auth::login($user);
        return redirect('welcome')->with('success', '¡Tu cuenta se ha creado!');
    }
  }

  /**
   * Login api
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {

    $remember_me = $request->remember_me;

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {
        if($remember_me === 'null'){
            Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(1));
        }
      $user = Auth::user();
      $success['token'] =  $user->createToken('MyApp')->accessToken;
    //   $success['token'] =  $user->createToken('MyApp');
    //   $strToken = $success['token']->accessToken;
    //   $expiration = $success['token']->token->expires_at->diffInSeconds(Carbon::now());
      $success['user'] = [
        'user' => Auth::user()
      ];

      if($request->path() === 'api/login') {
          return $this->sendResponse($success, 'Has iniciado sesión.');
      }
      else{
        session()->regenerate();
        session(['user' => $success['user']]);
        session()->flash('success', '¡Bienvenido/a de vuelta!');
        return redirect()->route('welcome');
      }

    } else {
        if($request->path() === 'api/login'){
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorized']);
        }
        else{
            return redirect('/')->with('error', 'Ha habido un error en el usuario o en la contraseña.');
            // return back()->with('error', 'Ha habido un error en el usuario o en la contraseña.');
        }
    }
  }

  public function profile()
  {
    return response()->json(Auth::user());
  }

  public function oldPassword(Request $request){
    $user = User::where('email', '=', $request->email)->first();
    // return response()->json(['oldPass' => $user->password]);
    return Hash::check($request->new, $user->password, []);
  }

  public function logout(Request $request)
  {
      if($request->path() === 'api/logout'){
        $token = $request->user()->token();
        $token->revoke();
        return response(['message' => 'Has cerrado sesión.'], 200);
    }
    else{
        auth()->logout();
        $request->session()->flush();
        return redirect('/')->with('success', 'Has cerrado sesión. ¡Hasta pronto!');
    }
  }
}
