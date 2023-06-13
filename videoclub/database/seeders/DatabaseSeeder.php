<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
        UsersTableSeeder::class,
        MoviesTableSeeder::class,
        ReviewsTableSeeder::class,
        PurchasesTableSeeder::class,
        GenresTableSeeder::class,
        AdminsTableSeeder::class,
        PremiumsTableSeeder::class,
        FreesTableSeeder::class,
        RentsTableSeeder::class,
        MovieGenresSeeder::class,
        ViewsTableSeeder::class,
    ]);

    // \App\Models\User::factory(10)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

  }
}
