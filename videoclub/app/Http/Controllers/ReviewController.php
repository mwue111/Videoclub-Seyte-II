<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
    $reviews = Review::orderBy('id', 'ASC')->get();
    return view('reviews.index', ['reviews' => $reviews]);
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
      'title' => 'required',
      'description' => 'required',
      'user_id' => 'required',
      'movie_id' => 'required',
    ]);
    //Creo el objeto a partir de los datos recibidos, lo guardo y lo devuelvo.
    $review = Review::create($request()->all());
    $review->save();
    return json_encode($review);
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
    $review->delete();
    return redirect()->route('resenas.index');
  }
}
