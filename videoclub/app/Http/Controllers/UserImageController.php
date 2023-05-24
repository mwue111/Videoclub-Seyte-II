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

class UserImageController extends Controller
{

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $attributes = $request->validate([
        'image' => 'required'
        ]);

        $imageData = $request->input('image');
        $decodedImage = base64_decode($imageData);

       // Generate a unique filename
        $filename = uniqid() . '.jpg';

        // Save the decoded image to the storage folder
        Storage::disk('public')->put('user_profile_img/' . $filename, $decodedImage);

        // Update the user's image attribute
        $user->image = "/user_profile_img/$filename";
        $user->save();

        return response()->json($user);
    }

    //No recibe formData desde el servicio
    public function updateWithFormData(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $attributes = $request->validate([
           'image' => 'nullable'
        ]);


        if(!$request->hasFile('image')){
            Log::debug("Qué recibe el controlador: ", $request->all());
            return response()->json('error'); //422
        }
        else{
            Log::debug("Qué recibe el controlador cuando sí hay image: ", $request->all());
            if(isset($user->image)){
                $old_image = $user->image;
                Storage::disk('public')->delete($old_image);
            }

            $filename = $request->file('image')->getClientOriginalName();
            $attributes['image'] = request()->file('image')->storeAs('user_profile_img', $filename, 'public');
        }

        $user->update($attributes);

        return response()->json($user);
    }
}
