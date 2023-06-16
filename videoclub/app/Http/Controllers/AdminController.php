<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

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

    public function login(Request $request) {
        return 'ok';
    }
}
