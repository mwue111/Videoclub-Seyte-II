<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function users() {
        return $this->belongsToMany(User::class, 'purchases');
    }

}
