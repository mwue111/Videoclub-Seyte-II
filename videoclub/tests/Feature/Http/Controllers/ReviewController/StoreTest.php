<?php

namespace Tests\Feature\Http\Controllers\ReviewController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;

class StoreTest extends TestCase
{
  /**
   * A basic feature test example.
   */
  use RefreshDatabase;
  public function test_store_review(): void
  {
    $user = User::factory()->create();
    $movie = Movie::factory()->create();
    $array = [
      'title' => 'Test title',
      'description' => 'Test description',
      'user_id' => strval($user->id),
      'movie_id' => strval($movie->id),
    ];
    $response = $this->post(route('resenas.store'), [
      'title' => 'Test title',
      'description' => 'Test description',
      'user_id' => $user->id,
      'movie_id' => $movie->id,
    ]);
    $response->assertStatus(200);
    $response->assertJson($array);
  }
}
