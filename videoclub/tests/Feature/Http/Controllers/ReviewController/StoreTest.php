<?php

namespace Tests\Feature\Http\Controllers\ReviewController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
  /**
   * A basic feature test example.
   */
  use RefreshDatabase;
  public function test_store_review(): void
  {

    $array = [
      'title' => 'Test title',
      'description' => 'Test description',
      'score' => '5',
      'user_id' => '1',
      'movie_id' => '1',
    ];
    $response = $this->post(route('resenas.store'), [
      'title' => 'Test title',
      'description' => 'Test description',
      'user_id' => 1,
      'movie_id' => 1,
    ]);
    $response->assertStatus(302);
    $response->assertJson($array);
  }
}
