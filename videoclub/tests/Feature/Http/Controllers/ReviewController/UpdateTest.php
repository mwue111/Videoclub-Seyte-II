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
    $review = Review::factory()->create();
    $review2 = [
      'title' => 'Test title',
      'description' => 'Test description',
      'user_id' => $review->user_id,
      'movie_id' => $review->movie_id,
    ];
    $response = $this->put(route('resenas.update', $review->id), $review2);
    $response->assertStatus(200);
    $response->assertJson([
      'title' => 'Test title',
      'description' => 'Test description',
      'user_id' => strval($review->user_id),
      'movie_id' => strval($review->movie_id),
    ]);
    $this->assertDatabaseHas('reviews', $review2);
    $this->assertDatabaseMissing('reviews', $review->toArray());
  }

  public function test_update_title_review()
  {
    $review = Review::factory()->create();
    $review2 = [
      'title' => 'Test title',
      'description' => $review->description,
      'user_id' => $review->user_id,
      'movie_id' => $review->movie_id,
    ];
    $response = $this->put(route('resenas.update', $review->id), $review2);
    $response->assertStatus(200);
    $response->assertJson([
      'title' => 'Test title',
      'description' => strval($review->description),
      'user_id' => strval($review->user_id),
      'movie_id' => strval($review->movie_id),
    ]);
    $this->assertDatabaseHas('reviews', $review2);
    $this->assertDatabaseMissing('reviews', $review->toArray());
  }
  public function test_update_review_non_existent()
  {
    $review = Review::factory()->create();
    $review2 = [
      'title' => 'Test title',
      'description' => $review->description,
      'user_id' => $review->user_id,
      'movie_id' => $review->movie_id,
    ];
    $response = $this->put(route('resenas.update', 10), $review2);
    $response->assertStatus(404);
    $response->assertNotFound();
  }

  public function test_update_review_with_wrong_data()
  {
    $review = Review::factory()->create();
    $response = $this->put(route('resenas.update', $review->id), [
      'title' => '',
      'description' => $review->description,
      'user_id' => $review->user_id,
      'movie_id' => $review->movie_id,
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors('title');
  }
}
