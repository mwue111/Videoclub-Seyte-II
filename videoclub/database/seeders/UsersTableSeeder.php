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
            'email' => 'admin@admin.com',
            'password' => '$2y$10$H6JH0Ak4RcxcnEXjml0nIe1/LmDAo2k5EC51o05x.C8SNeTVnIxAy',
            'image' => '',
            'surname' => 'apellido1',
            'birth_date' => '1985/01/01',
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'free-a-premium',
            'username' => 'free-premium',
            'email' => 'freetopremium@test.com',
            'password' => '$2y$10$qjw7WP7HPQNvB/mPGYa5medJ4qVXmRERXP8/vJN3ORKEd7wx2kr.m',
            'image' => 'user_profile_img/freetopremium@test.com/sally.jpg',
            'surname' => 'apellido2',
            'birth_date' => '1990/01/01',
            'role' => 'free',
        ]);

        DB::table('users')->insert([
            'name' => 'nombre3',
            'username' => 'premium-free',
            'email' => 'premiumtofree@test.com',
            'password' => '$2y$10$Y7OGprK8bk0guwuY5a/EDOjZEdptmopOZSXS1qnoPhHWncLsv0WTW',
            'image' => 'user_profile_img/premiumtofree@test.com/knuckles.jpg',
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
