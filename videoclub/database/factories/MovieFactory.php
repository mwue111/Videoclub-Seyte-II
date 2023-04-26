<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
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
        $video = UploadedFile::fake()->create('movie.mp4');
        $trailer = UploadedFile::fake()->create('trailer.mp4');

        return [
            'title' => fake()->sentence(),
            'poster' => fake()->image(),
            'banner' => fake()->image(),
            'year' => fake()->numberBetween(1930, 2023),
            'runtime' => fake()->numberBetween(60, 210),
            'plot' => fake()->paragraph(),
            'genre' => fake()->numberBetween(1, 4),
            'director'=>fake()->sentence(),
            'file' => $video,
            'trailer' => $trailer
        ];
    }
}
