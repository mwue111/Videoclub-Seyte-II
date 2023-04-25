<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Movie;
use App\Models\Genre;

class MovieGenre extends Pivot
{
    use HasFactory, SoftDeletes;

    // protected $table = 'movie_genre';
    protected $table = 'movie_genres';
    protected $dates = ['deleted_at'];  //convierte automáticamente en un objeto Carbon esta columna

    protected $fillable = [
        'movie_id',
        'genre_id',
        'deleted_at',
    ];

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
