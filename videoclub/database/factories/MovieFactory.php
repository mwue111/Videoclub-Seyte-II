<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'year' => fake()->year(),
            'runtime' => fake()->numberBetween(60, 210),
            'plot' => fake()->paragraph(),
            'genre' => fake()->sentence(),
            'director'=>fake()->sentence(),
        ];
    }
}
