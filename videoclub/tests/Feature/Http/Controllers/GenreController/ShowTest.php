<?php

namespace Tests\Feature\Http\Controllers\GenreController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Genre;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ShowTest extends TestCase
{
  use RefreshDatabase;
  use WithoutMiddleware;
  public function test_show_genre(): void
  {
    $genre = Genre::factory()->create();
    $this->get(route('generos.show', $genre))
      ->assertStatus(200)
      ->assertViewIs('genres.show')
      ->assertSee($genre->name)
      ->assertSee(route('generos.index'));
  }

  public function test_show_genre_not_found(): void
  {
    $this->get(route('generos.show', 'not_found'))
      ->assertStatus(404)
      ->assertNotFound();
  }
}
