<?php

namespace Tests\Feature\Http\Controllers\UserController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class IndexTest extends TestCase
{
  /**
   * A basic feature test example.
   */
  public function test_get_users(): void
  {
    $user = User::factory()->create();
    $response = $this->get(route('usuarios.index'));
    $response->assertStatus(200);
    $response->assertJson(User::all()->toArray());
  }

  public function test_get_user_admin(): void
  {
    $user = User::factory()->create();
    $user->admin()->create();
    $admin = $user->admin;
    $response = $this->get(route('usuarios.index'));
    $response->assertStatus(200);
    $response->assertJson(User::all()->toArray());
    $this->assertEquals($admin->user_id, $user->id);
  }

  public function test_get_user_premium(): void
  {
    $user = User::factory()->create();
    $user->premium()->create(['fecha_ultimo_pago' => '2021-01-01']);
    $premium = $user->premium;
    $response = $this->get(route('usuarios.index'));
    $response->assertStatus(200);
    $response->assertJson(User::all()->toArray());
    $this->assertEquals($premium->user_id, $user->id);
  }

  public function test_get_user_free(): void
  {
    $user = User::factory()->create();
    $user->free()->create();
    $free = $user->free;
    $response = $this->get(route('usuarios.index'));
    $response->assertStatus(200);
    $response->assertJson(User::all()->toArray());
    $this->assertEquals($free->user_id, $user->id);
  }

  public function test_no_users(): void
  {
    $response = $this->get(route('usuarios.index'));
    $response->assertStatus(200);
    $response->assertJson([]);
  }
}
