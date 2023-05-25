<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rents')->insert([
            'user_id' => 2,
            'movie_id' => 1,
            'expiration_date' => Carbon::now()->addDays(15),
        ]);

        DB::table('rents')->insert([
            'user_id' => 2,
            'movie_id' => 3,
            'expiration_date' => '2023-01-01',
        ]);

        DB::table('rents')->insert([
            'user_id' => 4,
            'movie_id' => 1,
            'expiration_date' => '2023-01-01',
        ]);

        DB::table('rents')->insert([
            'user_id' => 4,
            'movie_id' => 2,
            'expiration_date' => '2023-01-01',
        ]);

        DB::table('rents')->insert([
            'user_id' => 4,
            'movie_id' => 3,
            'expiration_date' => '2023-02-02',
        ]);

        DB::table('rents')->insert([
            'user_id' => 4,
            'movie_id' => 4,
            'expiration_date' => '2023-03-03',
        ]);

        DB::table('rents')->insert([
            'user_id' => 4,
            'movie_id' => 5,
            'expiration_date' => '2023-04-04',
        ]);

        DB::table('rents')->insert([
            'user_id' => 4,
            'movie_id' => 6,
            'expiration_date' => '2023-05-05',
        ]);

        DB::table('rents')->insert([
            'user_id' => 4,
            'movie_id' => 7,
            'expiration_date' => '2023-06-06',
        ]);
    }
}
