<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class SearchController extends Controller
{
    public function search(Request $request) {

        $querys = Movie::latest()->filter(request(['search']))->paginate(5);
        if(!$querys->count()){
            $querys = null;
        }
        return view('movies.found', ['movies' => $querys]);
    }
}
