<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
  use HasFactory;

  protected $table = 'premiums';
  protected $primaryKey = 'user_id';
  protected $fillable = [
    'user_id', 'payment_date'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function movies()
  {
    return $this->belongsToMany(Movie::class, 'views', 'user_id', 'movie_id')
                ->orderByDesc('views.updated_at')
                ->withTimestamps();
  }
}
