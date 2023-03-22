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
            'name' => 'required',
            'surname' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'image' => 'required|file',
            'birth_date' => 'required'
        ]);

        $user->update($request->all());

        return json_encode($user);
    }

    public function destroy($id) {
        $user = User::findOrFail($id)->destroy($id);
        return json_encode($user);
    }



}