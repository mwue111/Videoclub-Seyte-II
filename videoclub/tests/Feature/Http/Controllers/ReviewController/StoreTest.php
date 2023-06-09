<?php

namespace Tests\Feature\Http\Controllers\ReviewController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StoreTest extends TestCase
{
  /**
   * A basic feature test example.
   */
  use RefreshDatabase;
  use WithoutMiddleware;
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

  public function test_store_review_without_title(): void
  {
    $user = User::factory()->create();
    $movie = Movie::factory()->create();
    $response = $this->post(route('resenas.store'), [
      'description' => 'Test description',
      'user_id' => $user->id,
      'movie_id' => $movie->id,
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors('title');
  }

  public function test_store_review_without_description(): void
  {
    $user = User::factory()->create();
    $movie = Movie::factory()->create();
    $response = $this->post(route('resenas.store'), [
      'title' => 'Test title',
      'user_id' => $user->id,
      'movie_id' => $movie->id,
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors('description');
  }
  public function test_store_empty_review(): void
  {
    $response = $this->post(route('resenas.store'), []);
    $response->assertStatus(302);
    $response->assertSessionHasErrors('title');
    $response->assertSessionHasErrors('description');
    $response->assertSessionHasErrors('user_id');
    $response->assertSessionHasErrors('movie_id');
  }
}
