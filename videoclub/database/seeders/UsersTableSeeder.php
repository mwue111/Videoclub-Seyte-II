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

        DB::table('users')->insert([
            'name' => 'usuario',
            'username' => 'free2',
            'email' => 'free@free.com',
            'password' => '$2y$10$X617gDgMQgAIwctsZseuX.mP75.kWKFBlV7JsmPX1BI3aeX50nzTC',
            'image' => 'user_profile_img/free@free.com/free2.jpg',
            'surname' => 'free',
            'birth_date' => '2000/01/01',
            'role' => 'free',
        ]);

        DB::table('users')->insert([
            'name' => 'usuario',
            'username' => 'premium2',
            'email' => 'premium@premium.com',
            'password' => '$2y$10$ru7q4Tq8OKn3QpRUvNBRVOT5Qh3TeGtUs2ROH6APVjwl90OmDt442',
            'image' => 'user_profile_img/premium@premium.com/free2.jpg',
            'surname' => 'apellido',
            'birth_date' => '2000/01/01',
            'role' => 'premium',
        ]);
    }
}
