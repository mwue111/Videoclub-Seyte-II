<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MovieGenre;

class Genre extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
  ];

  public function movies()
  {
    return $this->belongsToMany(Movie::class, 'movie_genres')
                ->using(MovieGenre::class)
                ->withTimestamps();
  }
}
