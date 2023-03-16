<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Movie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      //
      'title' => fake()->sentence(),
      'description' => fake()->paragraph(),
      'user_id' => User::all()->random()->id,
      'movie_id' => Movie::all()->random()->id,
    ];
  }
}
