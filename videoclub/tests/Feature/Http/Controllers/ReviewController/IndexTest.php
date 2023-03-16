<?php

namespace Tests\Feature\Http\Controllers\ReviewController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Review;

class IndexTest extends TestCase
{
  use RefreshDatabase;
  public function test_show_review(): void
  {
    $review = Review::factory()->create();
    $response = $this->get(route('resenas.index'));
    $response->assertStatus(200);
    $response->assertViewIs('reviews.index');
    $response->assertSee($review->title);
    // $response->assertViewHas('reviews');
    // $response->assertViewHas('reviews', $review);
  }
}
