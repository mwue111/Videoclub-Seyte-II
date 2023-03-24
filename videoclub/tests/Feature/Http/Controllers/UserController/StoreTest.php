<?php

namespace Tests\Feature\Http\Controllers\UserController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class StoreTest extends TestCase
{

  public function test_store_free_user(): void
  {
    $userData = [
      'username' => 'username',
      'name' => 'name',
      'email' => 'email',
      'birth_date' => '2021-01-01',
      'role' => 'free',
      'password' => 'password',
    ];
    $response = $this->post(route('usuarios.store'), $userData);
    $response->assertStatus(200);
    $this->assertDatabaseHas('users', $userData);
    $this->assertDatabaseHas('frees', ['user_id' => User::where('username', 'username')->first()->id]);
  }
  public function test_store_admin_user(): void
  {
    $userData = [
      'username' => 'username',
      'name' => 'name',
      'email' => 'email1',
      'birth_date' => '2021-01-01',
      'role' => 'admin',
      'password' => 'password',
    ];
    $response = $this->post(route('usuarios.store'), $userData);
    $response->assertStatus(200);
    $this->assertDatabaseHas('users', $userData);
    $this->assertDatabaseHas('admins', ['user_id' => $response->json('id')]);
  }
  public function test_store_premium_user(): void
  {
    $userData = [
      'username' => 'username',
      'name' => 'name',
      'email' => 'email2',
      'birth_date' => '2021-01-01',
      'role' => 'premium',
      'password' => 'password',
    ];
    $response = $this->post(route('usuarios.store'), $userData);
    $response->assertStatus(200);
    $this->assertDatabaseHas('users', $userData);
    $this->assertDatabaseHas('premiums', ['user_id' => $response->json('id')]);
  }
  public function test_not_store_with_bad_args(): void
  {
    $userData = [
      'username' => 'username',
      'name' => 'name',
      'email' => '',
      'birth_date' => '2021-01-01',
      'role' => 'premium',
      'password' => 'password',
    ];
    $response = $this->post(route('usuarios.store'), $userData);
    $response->assertSessionHasErrors('email');
    $response->assertStatus(422);
  }
}
