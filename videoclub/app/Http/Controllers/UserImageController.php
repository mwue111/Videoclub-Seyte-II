<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Free;
use App\Models\Premium;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;

class UserImageController extends Controller
{

    //https://protone.media/en/blog/convert-and-store-base64-encoded-files-in-laravel-use-validation-rules-and-access-the-decoded-files-from-the-request-instance
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $attributes = $request->validate([
        'image' => 'required'
        ]);

        $imageData = $request->input('image');
        $decodedImage = base64_decode($imageData);
        $filename = uniqid() . '.jpg';

        if(isset($user->image)){
            $old_image = $user->image;
            Storage::disk('public')->delete($old_image);
        }

        // el guardado se hace con put():
        Storage::disk('public')->put('user_profile_img/' . $filename, $decodedImage);

        $user->image = "/user_profile_img/$filename";
        $user->save();

        return response()->json($user);
    }

    //No recibe formData desde el servicio
    public function updateWithFormData(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $attributes = $request->validate([
           'image' => 'image|nullable'
        ]);


        if(!$request->hasFile('image')){
            Log::debug("Qué recibe el controlador: ", $request->all());
            return response()->json('error'); //422
        }
        else{
            Log::debug("Qué recibe el controlador cuando sí hay image: ", $request->all());
            if(isset(Auth::user()->image)){
                $old_image = Auth::user()->image;
                Storage::disk('public')->delete($old_image);
            }

            $folderName = Auth::user()->email;

            $filename = $request->file('image')->getClientOriginalName();
            $attributes['image'] = request()->file('image')->storeAs('user_profile_img/' . $folderName, $filename, 'public');
        }

        $user->update($attributes);

        return response()->json($user);
    }
}
