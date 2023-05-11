<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class ReviewController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $reviews = Review::orderBy('id', 'ASC')->get();

    if ($request->path() == 'api/resenas') {
        return response()->json($reviews);
    }
    else {
        return view('reviews.index', ['reviews' => $reviews]);
    }
  }

  /**
   * Show the form for creating a new resource. No tiene sentido este controlador, ya que la vista se hará con angular.
   */

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //Valido que recibo los campos
    $request->validate([
      'user_id' => 'required',
      'movie_id' => 'required',
      'title' => 'required',
      'description' => 'required',
    ]);

    // $user = User::where('email', '=', $request->user_id)->first();
    $user = User::findOrFail($request->user_id);
    if(!$user){
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $data = $request->all();
    $data['user_id'] = $user->id;
    $review = Review::create($data);

    return json_encode($review, 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
    $review = Review::findOrFail($id);
    return view('reviews.show', ['review' => $review]);
  }

  /**
   * Show the form for editing the specified resource. No tiene sentido este controlador, ya que la vista se hará con angular.
   */
  // public function edit(string $id)
  // {
  //   //
  // }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //Busco la review, valido los campos que recibo, actualizo los campos y guardo.
    $review = Review::findOrFail($id);
    $request->validate([
      'title' => 'required',
      'description' => 'required',
      'user_id' => 'required',
      'movie_id' => 'required',
    ]);
    $review->title = $request->input('title');
    $review->description = $request->input('description');
    $review->user_id = $request->input('user_id');
    $review->movie_id = $request->input('movie_id');
    $review->save();
    return json_encode($review);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
    $review = Review::findOrFail($id);
    return $review->delete();
    // return redirect()->route('resenas.index');
  }

  public function findMovieReviews($id){
    $movie = Movie::findOrFail($id);
    foreach($movie->reviews as $review){
        $review->user_id = User::where('id', '=', $review->user_id)->get();
    }
    // dd($movie->reviews->toQuery()->paginate(3));
    if(($movie->reviews)->isEmpty()){
        return $movie->reviews = 'none';
    }
    else{
        return $movie->reviews->toQuery()->latest()->paginate(3);
    }
  }

  public function getReviews($id){
    $reviews = $this->findMovieReviews($id);
    return response()->json($reviews);
  }

  public function getAuthor($id){

    $reviews = $this->findMovieReviews($id);

    if(count($reviews) > 0){
        $authors = [];

        foreach($reviews as $review){
            $authors[] = $review->user;
        }
    }
    else{
        $authors = 'none';
    }

    return response()->json($authors);
  }

}
