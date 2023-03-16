<?php

namespace Tests\Feature\Http\Controllers\MovieController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Movie;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_all_movies(): void
    {
        $movie = Movie::factory()->create();

        $this->get(route('peliculas.index'))
            ->assertStatus(200)
            ->assertSee($movie->title)
            ->assertSee(route('peliculas.create'));
            //->assertSee(route('peliculas.create/show/edit/destroy')) cuando el usuario sea admin
    }

    public function test_it_displays_an_empty_message_if_there_is_no_movies() {

        $this->get(route('peliculas.index'))
            ->assertStatus(200)
            ->assertSee('No hay películas aún.');

    }

    public function test_it_displays_last_added_movies_first() {
        $firstMovie = Movie::factory()->create();
        $otherMovies = Movie::factory(5)->create();
        $lastMovie = Movie::factory()->create();

        $this->get(route('peliculas.index'))
            ->assertStatus(200)
            ->assertSee($lastMovie->title);
    }
}
