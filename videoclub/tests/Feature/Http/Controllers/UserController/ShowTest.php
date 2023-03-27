<?php

namespace Tests\Feature\Http\Controllers\UserController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ShowTest extends TestCase
{
  use RefreshDatabase;
  use WithoutMiddleware;
  public function test_show_user(): void
  {
    $user = User::factory()->create();
    $response = $this->get(route('usuarios.show', $user->id));
    $response->assertStatus(200);
    $response->assertJson($user->toArray());
  }
  public function test_not_showing_user(): void
  {
    $response = $this->get(route('usuarios.show', 0));
    $response->assertStatus(404);
  }
}
