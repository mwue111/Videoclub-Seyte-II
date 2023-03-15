<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('movies')->insert([
      'title' => 'Avatar',
      'year' => 2009,
      'runtime' => '162',
      'plot' => '
            Un infante de marina parapléjico enviado a la luna Pandora en una misión única se debate entre seguir sus órdenes y proteger el mundo que siente que es su hogar.',
      'genre' => 'accion',
      'director' => 'James Cameron'
    ]);

    DB::table('movies')->insert([
      'title' => 'Soy leyenda',
      'year' => 2007,
      'runtime' => '101',
      'plot' => '
            Años después de que una plaga mate a la mayor parte de la humanidad y transforme al resto en monstruos, el único sobreviviente en la ciudad de Nueva York lucha valientemente para encontrar una cura.',
      'genre' => 'drama',
      'director' => 'Francis Lawrence'
    ]);

    DB::table('movies')->insert([
      'title' => '300',
      'year' => 2006,
      'runtime' => '117',
      'plot' => 'El rey Leónidas de Esparta y una fuerza de 300 hombres luchan contra los persas en las Termópilas en el 480 a.C.',
      'genre' => 'accion',
      'director' => 'Zack Snyder'
    ]);
  }
}
