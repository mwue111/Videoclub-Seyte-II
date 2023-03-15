<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'nombre1',
            'username' => 'admin',
            'email' => 'nombre1@test.com',
            'password' => 'admin',
            'image' => 'url/de/imagen',
            'surname' => 'apellido1',
            'birth_date' => '1985/01/01'

        ]);
    }
}
