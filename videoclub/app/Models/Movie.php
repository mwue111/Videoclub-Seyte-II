<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Genre;
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
    'price',
  ];

  public function scopeFilter($query, array $filters) {

    if(isset($filters['search'])) {
        $genre = Genre::where('name', 'LIKE', '%' . $filters['search'] . '%')->first();

        if($genre){
            // $movies = $genre->movies()->where('genre_id', '=', $genre->id)->get();
            $query
                    ->where('title', 'LIKE', '%' . $filters['search'] . '%')
                    ->orWhere('director', 'LIKE', '%' . $filters['search'] . '%')
                    ->orWhere('year', '=', $filters['search'])
                    ->orWhereHas('genres', function($query) use ($genre) {
                        $query->where('genre_id', '=', $genre->id);
                    });
        }
        else{
            $query
                    ->where('title', 'LIKE', '%'. $filters['search'] . '%')
                    ->orWhere('director', 'LIKE', '%' . $filters['search'] . '%')
                    ->orWhere('year', '=', $filters['search']);
                    // ->paginate(5);
                    //orWhere $filters['search'] esté en la tabla genres->name, que devuelva el id de ese genre y todas las películas asociadas

        }
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
