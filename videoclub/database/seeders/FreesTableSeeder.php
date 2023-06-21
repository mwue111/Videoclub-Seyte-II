<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class FreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('frees')->insert([
            'user_id' => 2,
        ]);

        DB::table('frees')->insert([
            'user_id' => 4,
        ]);
    }
}
