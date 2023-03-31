<?php

namespace Tests\Feature\Http\Controllers\MovieController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use App\Models\Movie;

class EditTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_it_shows_the_edit_form_with_the_old_values(): void
    {
        $movie = Movie::factory()->create();

        $this->get(route('peliculas.edit', $movie))
            ->assertStatus(200)
            ->assertSee($movie->title)
            ->assertSee($movie->poster)
            ->assertSee($movie->year)
            ->assertSee($movie->runtime)
            ->assertSee($movie->plot)
            ->assertSee($movie->genre)
            ->assertSee($movie->director);
    }

    public function test_it_saves_new_files() {
        Storage::fake('public');

        $data = $this->oldFields([
            'poster' => $file = UploadedFile::fake()->image('poster.jpg'),
            'banner' => $banner = UploadedFile::fake()->image('banner.jpg'),
            'file' => $movie = UploadedFile::fake()->create('newVideo.mp4'),
            'trailer' => $trailer = UploadedFile::fake()->create('newTrailer.mp4')
        ]);

        $this->updateMovie($data)
            ->assertRedirect(route('peliculas.index'));

        Storage::disk('public')->assertExists('/images/' . $file->hashName())
                                ->assertExists('/images/' . $banner->hashName())
                                ->assertExists('/media/' . $movie->hashName())
                                ->assertExists('/trailer/' . $trailer->hashName());

        $this->assertDatabaseHas('movies', [
                                    'poster' => 'images/' . $file->hashName(),
                                    'banner' => 'images/' . $banner->hashName(),
                                    'file' => 'media/' . $movie->hashName(),
                                    'trailer' => 'trailer/' . $trailer->hashName()
                                ]);
    }

    public function test_it_saves_new_title() {

        $data = $this->oldFields(['title' => 'cambio']);

        $this->updateMovie($data)
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabaseHas('movies', ['title' => $data]);
    }

    public function test_it_saves_new_year(){

        $data = $this->oldFields(['year' => 1985]);

        $this->updateMovie($data)
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabaseHas('movies', ['year' => 1985]);
    }

    public function test_it_saves_new_runtime(){

        $data = $this->oldFields(['runtime' => 600]);

        $this->updateMovie($data)
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabaseHas('movies', ['runtime' => 600]);
    }

    public function test_it_saves_new_plot(){

        $data = $this->oldFields(['plot' => 'cambio']);

        $this->updateMovie($data)
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabaseHas('movies', ['plot' => 'cambio']);

    }

    public function test_it_saves_new_genre(){
        $data = $this->oldFields(['genre' => 2]);

        $this->updateMovie($data)
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabaseHas('movies', ['genre' => 2]);
    }

    public function test_it_saves_new_director(){

        $data = $this->oldFields(['director' => 'cambio']);

        $this->updateMovie($data)
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabaseHas('movies', ['director' => 'cambio']);

    }

    public function test_it_doesnt_save_incorrect_data() {

        $movie = Movie::factory()->create();
        $data = [
            'title' => 'nombre correcto',
            'poster' => 'url de un póster',
            'year' => 2000,
            'runtime' => 160,
            'plot' => 'sinopsis de una película de prueba',
            'genre' => 1,
            'director' => 'Alice Guy',
        ];

        $this->put(route('peliculas.update', $movie), $data)
            ->assertSessionHasErrors('poster')
            ->assertStatus(302);

    }

    public function test_it_doesnt_save_incorrect_files() {
        Storage::fake('public');

        $data = $this->oldFields([
            'poster' => $file = UploadedFile::fake()->create('poster.mp4'),
            'banner' => $banner = UploadedFile::fake()->create('banner.mp3'),
            'file' => $movie = UploadedFile::fake()->image('newVideo.jpg'),
            'trailer' => $trailer = UploadedFile::fake()->image('newTrailer.jpg')
        ]);

        $this->updateMovie($data)
            ->assertSessionHasErrors('poster')
            ->assertSessionHasErrors('banner')
            ->assertSessionHasErrors('trailer')
            ->assertSessionHasErrors('file');

        Storage::disk('public')->assertMissing('/images/' . $file->hashName())
                            ->assertMissing('/media/' . $movie->hashName())
                            ->assertMissing('/trailer/' . $trailer->hashName())
                            ->assertMissing('/images/' . $banner->hashName());

        $this->assertDatabaseMissing('movies', [
                                        'poster' => 'images/' . $file->hashName(),
                                        'banner' => 'images/' . $banner->hashName(),
                                        'file' => 'media/' . $movie->hashName(),
                                        'trailer' => 'trailer/' . $trailer->hashName()
                                    ]);
    }


    public function updateMovie($data = []) {

        $this->withExceptionHandling();

        return $this->post(route('peliculas.store'), $data);
    }

    public function oldFields($overrides = []): array {

        $poster = UploadedFile::fake()->image('poster.jpg');
        $banner = UploadedFile::fake()->image('banner.jpg');
        $file = UploadedFile::fake()->create('movie.mp4');
        $trailer = UploadedFile::fake()->create('trailer.mp4');

        return array_merge([
            'title' => 'Película de prueba',
            'poster' => $overrides === 'poster' ? 'image.jpg' : $poster,
            'banner' => $overrides === 'banner' ? 'banner.jpg' : $banner,
            'year' => 2000,
            'runtime' => 160,
            'plot' => 'sinopsis de una película de prueba',
            'genre_id' => 1,
            'director' => 'Alice Guy',
            'file' => $file,
            'trailer' => $trailer
        ], $overrides);

    }
}
