<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //
    DB::table('reviews')->insert([
      'user_id' => 1,
      'movie_id' => 1,
      'title' => 'Review 1',
      'description' => 'Descripcion de la review 1',
    ]);
    DB::table('reviews')->insert([
      'user_id' => 1,
      'movie_id' => 2,
      'title' => 'Review 2',
      'description' => 'Descripcion de la review 2',
    ]);
    DB::table('reviews')->insert([
      'user_id' => 1,
      'movie_id' => 3,
      'title' => 'Review 3',
      'description' => 'Descripcion de la review 3',
    ]);
  }
}
