<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cantidad = $request->input('cantidad');
      if ($cantidad) {
        $movies = Movie::latest('created_at')->take($cantidad)->get();
      } else {
        $movies = Movie::orderBy('id', 'DESC')->get();
      }
      if ($request->path() == 'api/peliculas') {
        return response()->json($movies);
      } else {
        return view('movies.index', [
          'movies' => $movies
        ]);
      }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|unique:movies,title',
            'poster' => 'required|image|mimes:jpg,jpeg,bmp,png',
            'year' => 'required',
            'runtime' => 'required',
            'plot' => 'required',
            'genre' => 'required',
            'director' => 'required',
            'file' => 'required|file|mimes:mp4,mp3,wav',
            'trailer' => 'required|file|mimes:mp4,mp3,wav',
        ]);

        $attributes['poster'] = request()->file('poster')->store('images', 'public');
        $attributes['file'] = request()->file('file')->store('media', 'public');
        $attributes['trailer'] = request()->file('trailer')->store('trailer', 'public');

        Movie::create($attributes);

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
            'movie' => $movie
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $attributes = $request->validate([
            'title' => 'required|unique:movies,title',
            'poster' => 'image|mimes:jpg,jpeg,bmp,png',
            'year' => 'required',
            'runtime' => 'required',
            'plot' => 'required',
            'genre' => 'required',
            'director' => 'required',
            'file' => 'file',
            'trailer' => 'file',
        ]);

        if(isset($attributes['poster'])){
            $attributes['poster'] = request()->file('poster')->store('images', 'public');
        }

        if(isset($attributes['file'])){
            $attributes['file'] = request()->file('file')->store('media', 'public');
        }

        if(isset($attributes['trailer'])){
            $attributes['trailer'] = request()->file('traielr')->store('trailer', 'public');
        }

        $movie->update($attributes);

        return redirect()->route('peliculas.index');//->withMessage('success', 'Película editada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        return redirect()->route('peliculas.index');
    }
}
