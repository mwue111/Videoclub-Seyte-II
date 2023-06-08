<?php

namespace App\Http\Controllers;

use App\Models\Premium;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
  public function index()
  {
    return Premium::all();
  }

  public function show($id)
  {
    $premium = Premium::findOrFail($id);
    return $premium->user;
  }
}
