<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class MovieController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $amount = $request->input('cantidad');

    if ($amount) {
      $movies = Movie::latest('created_at')->take($amount)->get();
    } else {
      $movies = Movie::orderBy('id', 'DESC')->get();
    }

    if ($request->path() == 'api/peliculas') {
      return response()->json($movies);
    } else {
      return view('movies.index', ['movies' => $movies]);
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('movies.create', ['genres' => Genre::all()]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $attributes = $request->validate([
      'title' => 'required|unique:movies,title',
      'poster' => 'required|image|mimes:jpg,jpeg,bmp,png',
      'banner' => 'required|image|mimes:jpg,jpeg,bmp,png',
      'year' => 'required|numeric',
      'runtime' => 'required|numeric',
      'plot' => 'required|max:5000',
      'director' => 'required',
      'file' => 'required|file|mimes:mp4,mp3,wav',
      'trailer' => 'required|file|mimes:mp4,mp3,wav',
    ]);

    $attributes['poster'] = request()->file('poster')->store('images', 'public');
    $attributes['banner'] = request()->file('banner')->store('images', 'public');
    $attributes['file'] = request()->file('file')->store('media', 'public');
    $attributes['trailer'] = request()->file('trailer')->store('trailer', 'public');

    $movie = Movie::create($attributes);
    $movie->genres()->attach($request->input('genre_id'), ['movie_id' => $movie->id]);
    return redirect()->route('peliculas.index');
  }



  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    $movie = Movie::findOrfail($id);

    return view('movies.show', [
      'movie' => $movie
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $movie = Movie::findOrFail($id);

    return view('movies.edit', [
      'movie' => $movie, 'genres' => Genre::all()
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {

    $movie = Movie::findOrFail($id);

    $attributes = $request->validate([
      'title' => 'required|unique:movies,title,' . $movie->id,
      'poster' => 'image|mimes:jpg,jpeg,bmp,png',
      'banner' => 'image|mimes:jpg,jpeg,bmp,png',
      'year' => 'required|numeric',
      'runtime' => 'required|numeric',
      'plot' => 'required|max:5000',
      'director' => 'required',
      'file' => 'file|mimes:mp4,mp3,wav',
      'trailer' => 'file|mimes:mp4,mp3,wav',
    ]);

    if ($request->hasFile('poster')) {
      $old_poster = $movie->poster;
      $attributes['poster'] = request()->file('poster')->store('images', 'public');
      Storage::disk('public')->delete($old_poster);
    }

    if ($request->hasFile('banner')) {
      $old_banner = $movie->banner;
      $attributes['banner'] = request()->file('banner')->store('images', 'public');
      Storage::disk('public')->delete($old_banner);
    }

    if (isset($attributes['file'])) {
      $old_file = $movie->file;
      $attributes['file'] = request()->file('file')->store('media', 'public');
      Storage::disk('public')->delete($old_file);
    }

    if (isset($attributes['trailer'])) {
      $old_trailer = $movie->trailer;
      $attributes['trailer'] = request()->file('trailer')->store('trailer', 'public');
      Storage::disk('public')->delete($old_trailer);
    }

    $movie->update($attributes);

    return redirect()->route('peliculas.index'); //->withMessage('success', 'Película editada');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $movie = Movie::findOrFail($id);

    $movie->genres()->detach();

    $movie->delete();

    return redirect()->route('peliculas.index');
  }

  public function addGenre(Request $request, $id)
  {
    $movie = Movie::findOrFail($id);

    $movie->genres()->attach($request->input('genre_id'), ['movie_id' => $movie->id]);

    // return redirect()->route('peliculas.index');
    return redirect()->route('peliculas.edit', ['pelicula' => $movie->id]);
  }

  public function deleteGenre(Request $request, $id)
  {
    $movie = Movie::findOrFail($id);

    $movie->genres()->detach($request->input('genre_id'));

    // return redirect()->route('peliculas.index');
    return redirect()->route('peliculas.edit', ['pelicula' => $movie->id]);
  }
}
