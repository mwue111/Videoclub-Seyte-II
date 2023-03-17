<?php

namespace Tests\Feature\Http\Controllers\ReviewController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;

class UpdateTest extends TestCase
{
  use RefreshDatabase;
  public function test_update_review(): void
  {
    $user = User::factory()->create();
    $movie = Movie::factory()->create();
    $review = Review::factory()->create();
    $review2 = [
      'title' => 'Test title',
      'description' => 'Test description',
      'user_id' => $user->id,
      'movie_id' => $movie->id,
    ];
    $response = $this->put(route('resenas.update', $review->id), $review2);
    $response->assertStatus(200);
    $response->assertJson([
      'title' => 'Test title',
      'description' => 'Test description',
      'user_id' => strval($user->id),
      'movie_id' => strval($movie->id),
    ]);
    $this->assertDatabaseHas('reviews', $review2);
    $this->assertDatabaseMissing('reviews', $review->toArray());
  }
}
