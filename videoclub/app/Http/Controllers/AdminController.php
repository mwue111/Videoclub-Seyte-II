<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Movie;

class AdminController extends Controller
{
    public function welcome() {
        return view('welcome.welcome');
    }

    public function loginForm() {
        return view('sessions.login');
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
