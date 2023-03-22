<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
  use HasFactory;

  protected $primaryKey = 'user_id';
  protected $fillabe = ['user_id', 'fecha_ultimo_pago'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
