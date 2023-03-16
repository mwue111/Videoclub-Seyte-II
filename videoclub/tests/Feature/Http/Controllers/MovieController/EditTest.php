<?php

namespace Tests\Feature\Http\Controllers\MovieController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Movie;

class EditTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_it_saves_new_data() {
        $movie = Movie::factory()->create();
        $data = [
                'title' => 'cambio de título',
                'poster' => 'url de un póster',
                'year' => 2000,
                'runtime' => 160,
                'plot' => 'sinopsis de una película de prueba',
                'genre' => 'drama',
                'director' => 'Alice Guy',
            ];


        $this->put(route('peliculas.update', $movie), $data)
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabaseHas('movies', $data);
    }

    public function test_it_doesnt_save_incorrect_data() {

        $movie = Movie::factory()->create();
        $data = [
            'title' => '',
            'poster' => 'url de un póster',
            'year' => 2000,
            'runtime' => 160,
            'plot' => 'sinopsis de una película de prueba',
            'genre' => 'drama',
            'director' => 'Alice Guy',
        ];

        $this->put(route('peliculas.update', $movie), $data)
            ->assertSessionHasErrors('title')
            ->assertStatus(302);

    }
}
