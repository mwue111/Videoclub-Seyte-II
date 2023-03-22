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
    public function index()
    {
        $movies = Movie::orderBy('id', 'DESC')->get();

        return view('movies.index', ['movies' => $movies ]);
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
            'poster' => 'required|image',
            'year' => 'required',
            'runtime' => 'required',
            'plot' => 'required',
            'genre' => 'required',
            'director' => 'required',
        ]);

        $attributes['poster'] = request()->file('poster')->store('images', 'public');

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
            'poster' => 'image',
            'year' => 'required',
            'runtime' => 'required',
            'plot' => 'required',
            'genre' => 'required',
            'director' => 'required',
        ]);

        if(isset($attributes['poster'])){
            $attributes['poster'] = request()->file('poster')->store('images', 'public');
        }
        //dd($attributes['poster']);

        $movie->update($attributes);

        //return redirect()->route('peliculas.index');//->withMessage('success', 'Película editada');
        return redirect()->route('peliculas.index');
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
