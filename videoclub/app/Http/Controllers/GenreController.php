<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
    $genres = Genre::orderBy('id', 'ASC')->get();
    return view('genres.index', ['genres' => $genres]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
    return view('genres.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
    $request->validate([
      'name' => 'required',
    ]);
    $genre = Genre::create($request->all());
    $genre->save();
    return redirect()->route('generos.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
    $genre = Genre::findOrFail($id);
    return view('genres.show', ['genre' => $genre]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
    $genre = Genre::findOrFail($id);
    return view('genres.edit', ['genre' => $genre]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
