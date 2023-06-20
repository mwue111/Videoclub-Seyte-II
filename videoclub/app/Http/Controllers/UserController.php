<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Free;
use App\Models\Premium;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Validator;

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
        case 'premium':
            $user->premium;
            break;
      }
    }
    // return json_encode($users);
    return view('users.index', ['users' => $users]);
  }

  public function show($id)
  {
    $user = User::findOrFail($id);
    return json_encode($user);
  }

  public function edit($id){
    $user = User::findOrFail($id);

    return view('users.edit', ['user' => $user]);
  }

  public function update(Request $request, $id)
  {
    $user = User::findOrFail($id);

    $attributes = $request->validate([
      'username' => 'string|nullable|unique:users,username,' . $user->id,
      'name' => 'string|nullable',
      'surname' => 'string|nullable',
      'email' => 'string|email|unique:users,email,' . $user->id,
      'birth_date' => 'date'
    ]);

    $user->update($attributes);

    if($request->path() === "api/usuarios/$id"){
        return json_encode($user);
    }
    else{
        $attributes = $request->validate([
            'image' => 'image'
        ]);

        if($request->hasFile('image')) {
            $old_avatar = $user->image;

            if($old_avatar){
                Storage::disk('public')->delete($old_avatar);
            }
            $filename = $request->file('image')->getClientOriginalName();

            $attributes['image'] = request()->file('image')->storeAs('user_profile_img/' . $user->email, $filename, 'public');
        }
        $user->update($attributes);

        $users = User::all();
        return view('users.index', ['users' => $users]);
    }
  }

  public function deleted() {
    $users = User::withTrashed()->where('deleted_at', '!=', null)->get();
    return view('users.deleted', ['users' => $users]);
  }

  public function restore($id) {
    $user = User::withTrashed()->findOrFail($id);
    $user->restore();

    switch($user->role){
        case 'free':
            // dd($user->reviews()->withTrashed()->where('deleted_at', '!=', null)->get());
            $user->reviews()
                ->withTrashed()
                ->restore();
                //intento 2:
                // ->where('deleted_at', '!=', null)
                // ->where('user_id', '=', $user->id)
                // ->update(['deleted_at' =>  null]);

                //intento 1:
                // ->findOrFail($user->id)
                // ->pivot
                // ->restore();

            dd($user->rents()->withTrashed());
            $user->rents
                ->withTrashed()
                ->findOrFail($user->id)
                ->pivot
                ->restore();
            break;
        case 'premium': break;
        case 'admin': break;
    }

    //recuperar las tablas relacionadas
    return redirect()->route('usuarios.index');
  }

  public function forceDelete($id) {
    User::withTrashed()->findOrFail($id)->forceDelete();
    return redirect()->route('usuarios.index');
  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);

    switch($user->role){
        case 'free':
                    if($user->reviews) {
                        $user->reviews->each->delete();
                    }
                    if($user->rents){
                        $user->rents->each(function ($rent) {
                            $rent->pivot->update(['deleted_at' => now()]);
                        });
                    }
                    $user->free->delete();
                    $user->delete();
                    break;
        case 'premium':
                    if($user->reviews){
                        $user->reviews->each->delete();
                    }
                    if($user->premium->movies){
                        $user->premium->movies->each(function ($view) {
                            $view->pivot->update(['deleted_at' => now()]);
                        });
                    }

                    $user->premium->delete();
                    $user->delete();
                    break;
        case 'admin': $user->admin->delete(); break;
    }

    User::destroy($id);

    $users = User::all();
    return view('users.index', ['users' => $users]);
  }
}
