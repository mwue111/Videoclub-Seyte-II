<?php

namespace Tests\Feature\Http\Controllers\MovieController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Movie;

class CreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * A basic feature test example.
     */
    public function test_it_shows_the_create_form(): void
    {
        $this->get(route('peliculas.create'))
            ->assertStatus(200)
            ->assertSee(route('peliculas.store'))
            ->assertSee(route('peliculas.index'));
    }

    public function test_it_requires_a_title() {

        $this->saveMovie(['title' => ''])
            ->assertSessionHasErrors('title');

    }

    public function test_it_requires_a_year() {

        $this->saveMovie(['year' => ''])
            ->assertSessionHasErrors('year');

    }

    public function test_it_requires_a_runtime() {

        $this->saveMovie(['runtime' => ''])
            ->assertSessionHasErrors('runtime');

    }

    public function test_it_requires_a_plot () {

        $this->saveMovie(['plot' => ''])
            ->assertSessionHasErrors('plot');

        }

    public function test_it_requires_a_genre () {

        $this->saveMovie(['genre' => null])
            ->assertSessionHasErrors('genre');

    }

    public function test_it_requires_a_director () {

        $this->saveMovie(['director' => ''])
            ->assertSessionHasErrors('director');
    }

    public function test_it_uploads_a_file() {
        Storage::fake('public');
        $movie = UploadedFile::fake()->create('movie.mp4');
        $file = UploadedFile::fake()->image('poster.jpg');
        $trailer = UploadedFile::fake()->create('trailer.mp4');

        $this->post(route('peliculas.store'), $this->validFields(['file' => $movie, 'poster' => $file, 'trailer' => $trailer]));

        Storage::disk('public')
                ->assertExists('/media/' . $movie->hashName())
                ->assertExists('/images/' . $file->hashName())
                ->assertExists('/trailer/' . $trailer->hashName());

    }

    public function saveMovie($data = []) {

        $this->withExceptionHandling();

        return $this->post(route('peliculas.store'), $this->validFields($data));

    }

    public function validFields($overrides = []): array {
        return array_merge([
            'title' => 'Película de prueba',
            'poster' => 'image.jpg',
            'year' => 2000,
            'runtime' => 160,
            'plot' => 'sinopsis de una película de prueba',
            'genre' => 1,
            'director' => 'Alice Guy',
            'file' => 'movie.mp4',
            'trailer' => 'trailer.mp4'
        ], $overrides);
    }

}
