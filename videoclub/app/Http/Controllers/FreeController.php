<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Free;

class FreeController extends Controller
{
  public function index()
  {
    return Free::all();
  }

  public function store(Request $request)
  {
    $free = Free::create($request->all());
    return response()->json($free, 201);
  }

  public function show($id)
  {
    $free = Free::findOrFail($id);
    $free->user;
    return $free;
  }
}
