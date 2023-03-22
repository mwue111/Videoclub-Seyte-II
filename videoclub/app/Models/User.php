<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
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
    'name',
    'username',
    'email',
    'password',
    'image',
    'surname',
    'birth_date',
    'role',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
    'role',
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

  public function movies()
  {
    return $this->belongsToMany(Movie::class, 'purchases')
      ->withPivot('expiration_date');
  }
  public function reviews()
  {
    return $this->belongsToMany(Movie::class, 'reviews')
      ->withPivot('title', 'description');
  }
}
