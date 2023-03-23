<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Free;
//use App\Models\Premium;   //usuario de pago

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        foreach($users as $user) {
            switch($user->role){
                case 'admin': $user->admin; break;
                case 'free': $user->free; break;
            }
        }
        return $users;
    }

    public function store(Request $request) {
        $user = User::create($request->all());

        switch($user->role){
            case 'admin': Admin::create(['user_id' => $user->id]); break;
            case 'free': Free::create(['user_id' => $user->id]); break;
        }

        return response_json($user);
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return json_encode($user);
    }

    public function update(Request $request, $id) {

        $user = User::findOrFail($id);

        $attributes = $request->validate([
            'email' => 'required|email',
            'birth_date' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        $user->update($request->all());

        return json_encode($user);
    }

    public function destroy($id) {
        $user = User::findOrFail($id)->destroy($id);
        return json_encode($user);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'Has iniciado sesión.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
