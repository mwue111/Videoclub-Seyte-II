<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Movie extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'title',
    'poster',
    'year',
    'runtime',
    'plot',
    'genre',
    'director',
    'file',
    'trailer',
  ];

  public function users()
  {
    return $this->belongsToMany(User::class, 'rents')
      ->withPivot('id', 'expiration_date')
      ->withTimeStamps();
  }
  public function reviews()
  {
    return $this->belongsToMany(User::class, 'reviews')
      ->withPivot('title', 'description');
  }
  public function genres()
  {
    return $this->belongsToMany(Genre::class, 'movies_genres');
  }
  public function premiums()
  {
    return $this->belongsToMany(Premium::class, 'views');
  }
}
