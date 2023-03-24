<?php

namespace Tests\Feature\Http\Controllers\UserController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class StoreTest extends TestCase
{
  use RefreshDatabase;
  public function test_store_free_user(): void
  {
    $userData = [
      'username' => 'username1',
      'name' => 'name',
      'email' => 'email@email.com',
      'birth_date' => '2021-01-01',
      'role' => 'free',
      'password' => 'password',
    ];
    $response = $this->post(route('usuarios.store'), $userData);
    $this->assertDatabaseHas('users', $userData);
    $this->assertDatabaseHas('frees', ['user_id' => $response->json('id')]);
  }
  public function test_store_admin_user(): void
  {
    $userData = [
      'username' => 'username2',
      'name' => 'name',
      'email' => 'email1@email.com',
      'birth_date' => '2021-01-01',
      'role' => 'admin',
      'password' => 'password',
    ];
    $response = $this->post(route('usuarios.store'), $userData);
    $this->assertDatabaseHas('users', $userData);
    $this->assertDatabaseHas('admins', ['user_id' => $response->json('id')]);
  }
  public function test_store_premium_user(): void
  {
    $userData = [
      'username' => 'username3',
      'name' => 'name',
      'email' => 'email2@email.com',
      'birth_date' => '2021-01-01',
      'role' => 'premium',
      'password' => 'password',
    ];
    $response = $this->post(route('usuarios.store'), $userData);
    $this->assertDatabaseHas('users', $userData);
    $this->assertDatabaseHas('premiums', ['user_id' => $response->json('id')]);
  }
  public function test_not_store_with_bad_args(): void
  {
    $userData = [
      'username' => 'username4',
      'name' => 'name',
      'email' => '',
      'birth_date' => '2021-01-01',
      'role' => 'premium',
      'password' => 'password',
    ];
    $response = $this->post(route('usuarios.store'), $userData);
    $response->assertSessionHasErrors('email');
  }
}
