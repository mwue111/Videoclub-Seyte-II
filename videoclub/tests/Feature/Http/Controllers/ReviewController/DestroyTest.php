<?php

namespace Tests\Feature\Http\Controllers\ReviewController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Review;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DestroyTest extends TestCase
{
  use RefreshDatabase;
  use WithoutMiddleware;
  public function test_delete_review(): void
  {
    $review = Review::factory()->create();
    $response = $this->delete(route('resenas.destroy', $review));
    $response->assertStatus(302);
    // $response->assertViewIs('reviews.index');
    $response->assertRedirect('resenas');
  }
  public function test_delete_review_not_found(): void
  {
    $response = $this->delete(route('resenas.destroy', 'not_found'));
    $response->assertStatus(404);
  }
  public function test_delete_reviews(): void
  {
    $reviews = Review::factory()->count(5)->create();
    foreach ($reviews as $review) {
      $response = $this->delete(route('resenas.destroy', $review));
      $response->assertStatus(302);
      $response->assertRedirect('resenas');
    }
  }
}
