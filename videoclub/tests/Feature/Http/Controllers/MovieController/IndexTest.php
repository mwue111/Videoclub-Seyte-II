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
            ->assertSee($movie->title);
    }

}
