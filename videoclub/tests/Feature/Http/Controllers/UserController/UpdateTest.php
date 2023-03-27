<?php

namespace Tests\Feature\Http\Controllers\UserController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use function PHPUnit\Framework\assertNotEquals;

class UpdateTest extends TestCase
{
  use RefreshDatabase;
  use WithoutMiddleware;
  public function test_update_user()
  {

    $userData = [
      'username' => 'username1',
      'name' => 'name',
      'email' => 'email@email.com',
      'birth_date' => '2021-01-01',
      'role' => 'free',
      'password' => 'password',
    ];
    $user = User::create($userData);
    $userData2 = [
      'username' => 'username2',
      'name' => 'name',
      'email' => 'email@email.com',
      'birth_date' => '2021-01-01',
      'role' => 'free',
      'password' => 'password',
    ];
    $response = $this->put(route('usuarios.update', $user->id), $userData2);
    $user = User::find($user->id);
    $this->assertDatabaseHas('users', [
      'username' => 'username2',
    ]);
    $response->assertJson($user->toArray());
  }
  public function test_update_user_not_found()
  {
    $userData = [
      'username' => 'username2',
      'name' => 'name',
      'email' => 'email@email.com',
      'birth_date' => '2021-01-01',
      'role' => 'free',
      'password' => 'password',
    ];
    $response = $this->put(route('usuarios.update', 20), $userData);
    $response->assertStatus(404);
    $response->assertNotFound();
  }
  public function test_update_user_with_wrong_data()
  {
    $userData = [
      'username' => 'username1',
      'name' => 'name',
      'email' => '',
    ];
    $user = User::factory()->create();
    $response = $this->put(route('usuarios.update', $user->id), $userData);
    $response->assertStatus(302);
    $response->assertSessionHasErrors('email');
  }
}
