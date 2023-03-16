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
        foreach($movies as $movie){
            $movie->poster_filename = Storage::url('images/' . $movie->poster);
        }
        dd($movie->poster_filename);
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

        //dd($request->poster);
        $request->validate([
            'title' => 'required',
            'poster' => 'required',
            'year' => 'required',
            'runtime' => 'required',
            'plot' => 'required',
            'genre' => 'required',
            'director' => 'required',
        ]);

        //Aquí: hacer que se guarde en storage/images
        $imageName = time() . '.' . $request->poster->extension();
        $request->poster->move(public_path('images'), $imageName);

        Movie::create($request->all());

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

        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'runtime' => 'required',
            'plot' => 'required',
            'genre' => 'required',
            'director' => 'required',
        ]);

        $movie->update($request->all());

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
