<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
  use HasFactory, SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'movie_id',
    'title',
    'description',
  ];

  //nuevos:

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function movie() {
    return $this->belongsTo(Movie::class);
  }
}
