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
  ];

  public function users()
  {
    return $this->belongsToMany(User::class, 'purchases')
      ->withPivot('expiration_date');
  }
  public function reviews()
  {
    return $this->belongsToMany(User::class, 'reviews')
      ->withPivot('title', 'description');
  }

}
