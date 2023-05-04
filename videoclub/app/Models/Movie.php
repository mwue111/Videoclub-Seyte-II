<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\MovieGenre;

class Movie extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'title',
    'poster',
    'banner',
    'year',
    'runtime',
    'plot',
    'director',
    'file',
    'trailer',
  ];

  public function scopeFilter($query, array $filters) {

    if(isset($filters['search'])) {
        $query
                ->where('title', 'LIKE', '%'. $filters['search'] . '%')
                ->orWhere('director', 'LIKE', '%' . $filters['search'] . '%')
                ->orWhere('year', '=', $filters['search'])
                ->paginate(5);
    }
    else{
        $query = Movie::latest()->paginate(5);
    }

  }

  public function users()
  {
    return $this->belongsToMany(User::class, 'rents')
      ->withPivot('id', 'expiration_date')
      ->withTimeStamps();
  }

  //Lo que había:
//   public function reviews()
//   {
//     return $this->belongsToMany(User::class, 'reviews')
//       ->withPivot('title', 'description');
//   }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

  public function genres()
  {
    return $this->belongsToMany(Genre::class, 'movie_genres')
                ->using(MovieGenre::class)
                ->withTimestamps();
  }

  public function premiums()
  {
    return $this->belongsToMany(Premium::class, 'views', 'movie_id', 'user_id')
                ->withTimestamps();
  }
}
