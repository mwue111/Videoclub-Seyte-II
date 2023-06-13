<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PremiumsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //
    DB::table('premiums')->insert([
      'user_id' => 1,
      'payment_date' => '2021-07-22',
    ]);

    DB::table('premiums')->insert([
      'user_id' => 5,
      'payment_date' => Carbon::now(),
    ]);
  }
}
