<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class SearchController extends Controller
{
    public function search(Request $request) {
        // $data = $request->search;

        // if(isset($data)) {
        //     $querys = Movie::where('title', 'LIKE', '%'. $data . '%')
        //                     ->orWhere('director', 'LIKE', '%' . $data . '%')
        //                     ->orWhere('year', '=', $data)
        //                     ->paginate(5);

        //     if(!$querys->count()){
        //         $querys = null;
        //     }
        // }
        // else{
        //     $querys = Movie::latest()->paginate(5);
        // }

        //con autocomplete de jQuery será necesario que se pase una key label:
        // $response = [];

        // foreach($querys as $query){
        //     $response[] = [
        //         // 'id' => $query->id,
        //         'label' => $query->title
        //     ];
        // }

        // return response()->json($response);
        // return view('movies.found', ['movies' => $querys]);

        $querys = Movie::latest()->filter(request(['search']))->paginate(5);
        if(!$querys->count()){
            $querys = null;
        }
        return view('movies.found', ['movies' => $querys]);
    }
}
