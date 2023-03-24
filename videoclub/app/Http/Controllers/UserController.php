<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Free;
use App\Models\Premium;

class UserController extends Controller
{
  public function index()
  {
    $users = User::all();
    foreach ($users as $user) {
      switch ($user->role) {
        case 'admin':
          $user->admin;
          break;
        case 'free':
          $user->free;
          break;
      }
    }
    return json_encode($users);
  }

  public function store(Request $request)
  {
    $request->validate([
      'username' => 'unique:users,username',
      'email' => 'required|email',
      'password' => 'required',
      'role' => 'required',
    ]);
    $user = User::create($request->all());

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
    $user->save();
    return json_encode($user);
  }

  public function show($id)
  {
    $user = User::findOrFail($id);
    return json_encode($user);
  }

  public function update(Request $request, $id)
  {

    $user = User::findOrFail($id);

    $request->validate([
      'username' => 'unique:users,username',
      'email' => 'required|email',
      'password' => 'required',
      'role' => 'required',
    ]);

    $user->update($request->all());

    return json_encode($user);
  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);
    User::destroy($id);
    return json_encode($user);
  }
}
