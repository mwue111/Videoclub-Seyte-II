<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Free;
use App\Models\Premium;
use Illuminate\Support\Facades\Storage;

class UserImageController extends Controller
{

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);

        $attributes = $request->validate([
        'image' => 'file|nullable'
        ]);

        if($request->hasFile('image')){

            if(isset($user->image)){
                $old_image = $user->image;
                Storage::disk('public')->delete($old_image);
            }

            $filename = $request->file('image')->getClientOriginalName();
            $attributes['image'] = request()->file('image')->storeAs('user_profile_img', $filename, 'public',);
        }

        $user->update($attributes);
        // dd($user);
        return response()->json($user);;
    }
}
