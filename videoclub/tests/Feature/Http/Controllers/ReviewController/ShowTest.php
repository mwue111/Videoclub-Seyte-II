<?php

namespace Tests\Feature\Http\Controllers\ReviewController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Review;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ShowTest extends TestCase
{
  use RefreshDatabase;
  use WithoutMiddleware;
  public function test_show_review(): void
  {
    $review = Review::factory()->create();
    $response = $this->get(route('resenas.show', $review));
    $response->assertStatus(200);
    $response->assertViewIs('reviews.show');
    $response->assertSee($review->title);
    $response->assertSee($review->description);
  }
  public function test_show_review_not_found(): void
  {
    $response = $this->get(route('resenas.show', 'not_found'));
    $response->assertStatus(404);
    $response->assertNotFound();
  }
}
