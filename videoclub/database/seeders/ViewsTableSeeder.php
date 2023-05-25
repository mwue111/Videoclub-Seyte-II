<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('views')->insert([
            'movie_id' => 1,
            'user_id' => 4
        ]);
        DB::table('views')->insert([
            'movie_id' => 2,
            'user_id' => 4
        ]);
        DB::table('views')->insert([
            'movie_id' => 3,
            'user_id' => 4
        ]);
        DB::table('views')->insert([
            'movie_id' => 4,
            'user_id' => 4
        ]);
        DB::table('views')->insert([
            'movie_id' => 5,
            'user_id' => 4
        ]);
        DB::table('views')->insert([
            'movie_id' => 6,
            'user_id' => 4
        ]);
        DB::table('views')->insert([
            'movie_id' => 7,
            'user_id' => 4
        ]);
    }
}
