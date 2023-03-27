<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Free;

class FreeController extends Controller
{
    public function index() {
        return Free::all();
    }

    public function show($id) {
        $free = Free::findOrFail($id);
        $free->user;
        return $free;
    }
}
