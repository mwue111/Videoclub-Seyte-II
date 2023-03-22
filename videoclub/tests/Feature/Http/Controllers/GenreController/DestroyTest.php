<?php

namespace Tests\Feature\Http\Controllers\GenreController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Genre;

class DestroyTest extends TestCase
{
  use RefreshDatabase;
  public function test_delete_genre(): void
  {
    $genre = Genre::factory()->create();
    $this->delete(route('generos.destroy', $genre))
      ->assertStatus(302)
      ->assertRedirect('generos');
    $this->assertDatabaseMissing('genres', ['id' => $genre->id]);
  }

  public function test_delete_genres(): void
  {
    $genres = Genre::factory()->count(5)->create();
    foreach ($genres as $genre) {
      $this->delete(route('generos.destroy', $genre))
        ->assertStatus(302)
        ->assertRedirect('generos');
      $this->assertDatabaseMissing('genres', ['id' => $genre->id]);
    }
  }

  public function test_delete_genre_not_found(): void
  {
    $this->delete(route('generos.destroy', 'not_found'))
      ->assertStatus(404)
      ->assertNotFound();
  }
}
