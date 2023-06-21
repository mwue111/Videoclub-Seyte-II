<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */

  protected $fillable = [
    'username',
    'email',
    'password',
    'birth_date',
    'surname',
    'role',
    'image',
    'name'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function admin()
  {
    return $this->hasOne(Admin::class);
  }

  public function free()
  {
    return $this->hasOne(Free::class);
  }

  public function premium()
  {
    return $this->hasOne(Premium::class);
  }

  public function rents()
{
    return $this->belongsToMany(Movie::class, 'rents', 'user_id', 'movie_id')
        ->withPivot('id', 'expiration_date', 'deleted_at')
        ->orderByDesc('rents.id')
        ->withTimestamps();
}

//   public function rents()
//   {
//     return $this->belongsToMany(Movie::class, 'rents')
//       ->withPivot('id', 'expiration_date', 'deleted_at')
//       ->orderByDesc('rents.id')
//       ->withTimeStamps();
//   }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
