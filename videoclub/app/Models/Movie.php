<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'runtime',
        'plot',
        'genre',
        'director',
    ];

    // public function purchases() {
    //     return $this->belongsToMany(User::class);
    // }

    // public function reviews() {
    //     return $this->hasMany(Review::class);
    // }

}
