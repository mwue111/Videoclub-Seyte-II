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

        $data = $this->oldFields(['poster' => $file = UploadedFile::fake()->image('poster.jpg'), 'file' => $movie = UploadedFile::fake()->create('newVideo.mp4')]);

        $this->updateMovie($data)
            ->assertRedirect(route('peliculas.index'));

        Storage::disk('public')->assertExists('/images/' . $file->hashName())
                                ->assertExists('/media/' . $movie->hashName());

        $this->assertDatabaseHas('movies', ['poster' => 'images/' . $file->hashName()]);
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
        $data = $this->oldFields(['genre' => 'nuevo']);

        $this->updateMovie($data)
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabaseHas('movies', ['genre' => 'nuevo']);
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
            'genre' => 'drama',
            'director' => 'Alice Guy',
        ];

        $this->put(route('peliculas.update', $movie), $data)
            ->assertSessionHasErrors('poster')
            ->assertStatus(302);

    }

    public function test_it_doesnt_save_incorrect_files() {
        Storage::fake('public');

        $data = $this->oldFields(['poster' => $file = UploadedFile::fake()->image('poster.mp4'), 'file' => $movie = UploadedFile::fake()->create('newVideo.jpg')]);

        $this->updateMovie($data)
            ->assertSessionHasErrors('poster')
            ->assertSessionHasErrors('file');

        Storage::disk('public')->assertMissing('/images/' . $file->hashName())
                            ->assertMissing('/media/' . $movie->hashName());

        $this->assertDatabaseMissing('movies', ['poster' => 'images/' . $file->hashName()]);
    }


    public function updateMovie($data = []) {

        $this->withExceptionHandling();

        return $this->post(route('peliculas.store'), $data);
    }

    public function oldFields($overrides = []): array {

        $poster = UploadedFile::fake()->image('poster.jpg');
        $file = UploadedFile::fake()->create('movie.mp4');

        return array_merge([
            'title' => 'Película de prueba',
            'poster' => $overrides === 'poster' ? 'image.jpg' : $poster,
            'year' => 2000,
            'runtime' => 160,
            'plot' => 'sinopsis de una película de prueba',
            'genre' => 'drama',
            'director' => 'Alice Guy',
            'file' => $file
        ], $overrides);

    }
}
