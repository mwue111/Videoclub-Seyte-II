<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //
    DB::table('reviews')->insert([
      'user_id' => 1,
      'pelicula_id' => 1,
      'titulo' => 'Review 1',
      'descripcion' => 'Descripcion de la review 1',
    ]);
    DB::table('reviews')->insert([
      'user_id' => 1,
      'pelicula_id' => 2,
      'titulo' => 'Review 2',
      'descripcion' => 'Descripcion de la review 2',
    ]);
    DB::table('reviews')->insert([
      'user_id' => 1,
      'pelicula_id' => 3,
      'titulo' => 'Review 3',
      'descripcion' => 'Descripcion de la review 3',
    ]);
  }
}
