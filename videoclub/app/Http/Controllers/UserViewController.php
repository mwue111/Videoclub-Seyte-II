<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;    //rents
use App\Models\Free;
use App\Models\Premium; //views
use App\Models\Review;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class UserViewController extends Controller
{
    public function index(){
        $rents = Auth::user()->rents;
        return response()->json($rents);
    }

    public function show($id){
        $user = User::findOrFail($id);
        if($user->id === Auth::user()->id){ //puede quitarse
            // $reviews = $user->reviews->sortByDesc('updated_at');
            // $reviews = Review::orderBy('id', 'DESC')->where('user_id', '=', $user->id)->get();
            $reviews = Review::orderBy('id', 'DESC')->where('user_id', '=', $user->id)->paginate(4);
            $movies = [];

            foreach($reviews as $review) {
                $review->movie_id = Movie::where('id', '=', $review->movie_id)->first();;
            }
        }
        return response()->json($reviews);
    }

    /*Paginación:
     public function findMovieReviews($id, $page){
    $movie = Movie::findOrFail($id);

    if(($movie->reviews)->isEmpty()){
        return 'none';
    }
    else{
        $pagination = $movie->reviews->toQuery()->latest()->paginate(4, ['*'], 'page', $page);

        foreach($pagination as $p){
            $p->user_id = User::where('id', '=', $p->user_id)->get();
        }

        return $pagination;
    }
    }

    public function getReviews($id, $page){
        $reviews = $this->findMovieReviews($id, $page);
        return response()->json($reviews);
    }
  */
}
