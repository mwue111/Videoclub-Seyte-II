<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;    //rents
use App\Models\Free;
use App\Models\Premium; //views
use App\Models\Review;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Http\Controllers\API\BaseController as BaseController;

class UserViewController extends BaseController
{
    //vistas/alquiladas
    public function index(){
        $user = User::findOrFail(Auth::user()->id);
        if($user->role === 'premium'){
            $views = $user->premium->movies;
            if(count($views)){
                $response = $user->premium->movies;
            }
            else{
                $response = null;
            }
        }
        else if($user->role === 'free'){
            $rents = Auth::user()->rents;
            if(count($rents)){
                $response = Auth::user()->rents; //->toQuery()->orderByDesc('id', 'desc')->get();
            }
            else{
                $response = null;
            }
        }

        return response()->json($response);
    }

    //reseñas
    public function show($id, $page){
        $user = User::findOrFail($id);
        if($user->id === Auth::user()->id){ //puede quitarse
            // $reviews = $user->reviews->sortByDesc('updated_at');
            // $reviews = Review::orderBy('id', 'DESC')->where('user_id', '=', $user->id)->get();

            if(($user->reviews)->isEmpty()){
                $reviews = 'none';
            }
            else{
                $reviews = Review::orderBy('id', 'DESC')->where('user_id', '=', $user->id)->paginate(4, ['*'], 'page', $page);
                $movies = [];

                foreach($reviews as $review) {
                    $review->movie_id = Movie::where('id', '=', $review->movie_id)->first();;
                }
                return $reviews;
            }
        }
        return response()->json($reviews);
    }

    //crear un registro en la tabla views
    public function store(Request $request, $id) {

        $intId = (int)$id;

        if(Auth::user()->id === $intId) {
            $user = Auth::user();
            if($user->role === 'premium') {
                $validator = Validator::make($request->all(), [
                    'movie_id' => 'required',
                ]);

                if($validator->fails()) {
                    return $this->sendError('Falta el id de la película.', $validator->errors());
                }

                $view = $user->premium->movies()->attach([
                    $request->input('movie_id')
                ]);

                return $this->sendResponse($view, 'Registro de vista creado');
            }
        }
    }
}
