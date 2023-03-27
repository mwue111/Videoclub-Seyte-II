<?php

namespace Tests\Feature\Http\Controllers\GenreController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Genre;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EditTest extends TestCase
{
  use refreshDatabase;
  use WithoutMiddleware;
  public function test_show_old_genre_values(): void
  {
    $genre = Genre::factory()->create();
    $this->get(route('generos.edit', $genre))
      ->assertViewIs('genres.edit')
      ->assertStatus(200)
      ->assertSee($genre->name);
  }
  public function test_store_new_genre_values(): void
  {
    $genre = Genre::factory()->create();
    $this->patch(route('generos.update', $genre), [
      'name' => 'cambio',
    ])
      ->assertRedirect(route('generos.index'));
    $this->assertDatabaseHas('genres', ['name' => 'cambio']);
  }

  public function test_not_store_invalid_values(): void
  {
    $genre = Genre::factory()->create();
    $this->patch(route('generos.update', $genre), [
      'name' => '',
    ])
      ->assertSessionHasErrors(['name']);
    $this->assertDatabaseHas('genres', ['name' => $genre->name]);
  }
}
