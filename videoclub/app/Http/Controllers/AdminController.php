<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Movie;

class AdminController extends Controller
{

    public function loginForm() {
        return view('admin.login');
    }

    public function index() {
        return Admin::all();
    }

    public function show($id) {
        $admin = Admin::findOrFail($id);
        $admin->user;
        return $admin;
    }
}
