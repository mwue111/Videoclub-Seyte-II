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
      'poster' => 'images/FRS0hqqhxjs0x9QUcl1lKeCwcpUjkkI3Xiyve03s.jpg',
      'banner' => 'images/FRS0hqqhxjs0x9QUcl1lKeCwcpUjkkI3Xiyve03s.jpg',
      'year' => 2009,
      'runtime' => '162',
      'plot' => '
            Un infante de marina parapléjico enviado a la luna Pandora en una misión única se debate entre seguir sus órdenes y proteger el mundo que siente que es su hogar.',
      'genre_id' => 1,
      'director' => 'James Cameron',
      'file' => 'file/de/la/pelicula',
      'trailer' => 'trailer/de/la/pelicula',
      'created_at' => '2023/01/30'
    ]);

    DB::table('movies')->insert([
      'title' => 'Soy leyenda',
      'poster' => 'images/VFfWG0JHOM4ruZglNFt9UlqflMgMvHGRfnDJfILM.jpg',
      'banner' => 'images/VFfWG0JHOM4ruZglNFt9UlqflMgMvHGRfnDJfILM.jpg',
      'year' => 2007,
      'runtime' => '101',
      'plot' => '
            Años después de que una plaga mate a la mayor parte de la humanidad y transforme al resto en monstruos, el único sobreviviente en la ciudad de Nueva York lucha valientemente para encontrar una cura.',
      'genre_id' => 4,
      'director' => 'Francis Lawrence',
      'file' => 'file/de/la/pelicula',
      'trailer' => 'trailer/de/la/pelicula',
      'created_at' => '2023/02/28'
    ]);

    DB::table('movies')->insert([
      'title' => '300',
      'poster' => 'images/6WMQnzC4bTHC45mk4oN4Foy6aZEoiAZoPFDWMDn7.jpg',
      'banner' => 'images/6WMQnzC4bTHC45mk4oN4Foy6aZEoiAZoPFDWMDn7.jpg',
      'year' => 2006,
      'runtime' => '117',
      'plot' => 'El rey Leónidas de Esparta y una fuerza de 300 hombres luchan contra los persas en las Termópilas en el 480 a.C.',
      'genre_id' => 1,
      'director' => 'Zack Snyder',
      'file' => 'file/de/la/pelicula',
      'trailer' => 'trailer/de/la/pelicula',
      'created_at' => '2023/03/30'
    ]);
  }
}
