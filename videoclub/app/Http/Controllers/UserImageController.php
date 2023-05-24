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

class UserImageController extends Controller
{
    public function file(Request $request, $id) {
         $user = User::findOrFail($id);

         if($request->hasFile('image')) {
            $completeFileName = $request->file('image')->getClientOriginalName();                               //nombre del archivo
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);                                     //nombre del archivo SIN extensiones
            $extension = $request->file('image')->getClientOriginalExtension();                                 //extensión del archivo
            $compPic = str_replace(' ', '_', $fileNameOnly) . '-' . rand() . '_' . time() . '.' . $extension;   //nombre codificado e irrepetible
            $path = $request->file('image')->storeAs('public/posts', $compPic);
            $user->image = $compPic;
         }
         if($user->save()){
            return ['status' => true, 'message' => 'Imagen guardada.'];
        }
        else{
            return ['status' => false, 'message' => 'Ha ocurrido un error.'];
         }
    }
}
