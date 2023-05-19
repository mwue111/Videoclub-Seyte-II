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
    return json_encode($users);
  }

//   public function store(Request $request) {
//     $attributes = $request->validate([
//         'user_id' => 'required|numeric',
//         'image' => 'image|mimes:jpg,jpeg,png,bmp'
//     ]);

//     $user = User::findOrFail($request->user_id);

//     $attributes['image'] = request()->file('image')->store('user_profile_img', 'public');

//     $user->image = $attributes['image'];
//     $user->save();
//   }

  public function show($id)
  {
    $user = User::findOrFail($id);
    return json_encode($user);
  }

  public function update(Request $request, $id)
  {
    // dd($request->all());
    $user = User::findOrFail($id);
    // dd($user);

    $attributes = $request->validate([
      'username' => 'string|nullable|unique:users,username,' . $user->id,  //nullable todo salbo email y birth date
      'name' => 'string|nullable',
      'surname' => 'string|nullable',
      'email' => 'string|email|unique:users,email,' . $user->id,
      'birth_date' => 'date',
      'image' => 'image|nullable'
    ]);

    if($request->hasFile('image')){

        if(isset($user->image)){
            $old_image = $user->image;
            Storage::disk('public')->delete($old_image);
        }

        $attributes['image'] = request()->file('image')->store('user_profile_img', 'public');
    }

    $user->update($attributes);

    return json_encode($user);
  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);
    User::destroy($id);
    return json_encode($user);
  }
}
