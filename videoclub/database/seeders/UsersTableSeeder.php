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
            'password' => '12345678',
            'image' => 'url/de/imagen',
            'surname' => 'apellido1',
            'birth_date' => '1985/01/01',
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'nombre2',
            'username' => 'free',
            'email' => 'free@test.com',
            'password' => '12345678',
            'image' => 'url/de/imagen',
            'surname' => 'apellido2',
            'birth_date' => '1990/01/01',
            'role' => 'free',
        ]);

        DB::table('users')->insert([
            'name' => 'nombre3',
            'username' => 'premium',
            'email' => 'premium@test.com',
            'password' => '12345678',
            'image' => 'url/de/imagen',
            'surname' => 'apellido3',
            'birth_date' => '2000/01/01',
            'role' => 'premium',
        ]);
    }
}
