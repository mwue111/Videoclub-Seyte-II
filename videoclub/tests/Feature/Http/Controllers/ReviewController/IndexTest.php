<?php

namespace Tests\Feature\Http\Controllers\ReviewController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Review;

class IndexTest extends TestCase
{
  use RefreshDatabase;
  public function test_display_review(): void
  {
    $review = Review::factory()->create();
    $response = $this->get(route('resenas.index'));
    $response->assertStatus(200);
    $response->assertViewIs('reviews.index');
    $response->assertSee($review->title);
  }
  public function test_no_reviews(): void
  {
    $response = $this->get(route('resenas.index'));
    $response->assertStatus(200);
    $response->assertViewIs('reviews.index');
    $response->assertSee('No reviews');
  }
  public function test_display_reviews(): void
  {
    $reviews = Review::factory()->count(5)->create();
    $response = $this->get(route('resenas.index'));
    $response->assertStatus(200);
    $response->assertViewIs('reviews.index');
    foreach ($reviews as $review) {
      $response->assertSee($review->title);
    }
  }
}
