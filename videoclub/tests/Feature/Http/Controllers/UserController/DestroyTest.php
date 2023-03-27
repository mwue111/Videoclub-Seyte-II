<?php

namespace Tests\Feature\Http\Controllers\UserController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DestroyTest extends TestCase
{
  use RefreshDatabase;
  use WithoutMiddleware;
  public function test_delete_user(): void
  {
    $user = User::factory()->create();
    $response = $this->delete(route('usuarios.destroy', $user));
    $response->assertStatus(200);
    $response->assertJson($user->toArray());
    $this->assertDatabaseHas('users', $user->toArray()); //Se comprueba que está porque no se borra, se añade una columna softDelete
  }
  public function test_delete_user_not_found(): void
  {
    $response = $this->delete(route('usuarios.destroy', 'not_found'));
    $response->assertStatus(404);
  }
  public function test_delete_users(): void
  {
    $users = User::factory()->count(5)->create();
    foreach ($users as $user) {
      $response = $this->delete(route('usuarios.destroy', $user));
      $response->assertStatus(200);
      $response->assertJson($user->toArray());
      $this->assertDatabaseHas('users', $user->toArray()); //Se comprueba que está porque no se borra, se añade una columna softDelete
    }
  }
}
