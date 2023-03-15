<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchases')->insert([
            'user_id' => 1,
            'movie_id' => 1,
            'expiration_date' => '2023/04/14'
        ]);
        DB::table('purchases')->insert([
            'user_id' => 1,
            'movie_id' => 2,
            'expiration_date' => null
        ]);
        DB::table('purchases')->insert([
            'user_id' => 1,
            'movie_id' => 3,
            'expiration_date' => null
        ]);
    }
}
