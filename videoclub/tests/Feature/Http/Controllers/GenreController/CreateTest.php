<?php

namespace Tests\Feature\Http\Controllers\GenreController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;



class CreateTest extends TestCase
{
  use RefreshDatabase;
  public function test_show_form(): void
  {
    $this->get(route("generos.create"))
      ->assertStatus(200)
      ->assertSee(route("generos.store"))
      ->assertSee(route("generos.index"));
  }

  public function test_create_and_save_genre(): void
  {
    $data = [
      "name" => "Ciencia Ficción"
    ];

    $this->post(route("generos.store"), $data)
      ->assertRedirect(route("generos.index"));

    $this->assertDatabaseHas("genres", $data);
  }

  public function test_name_is_required(): void
  {
    $data = [
      "name" => ""
    ];
    $this->post(route("generos.store"), $data)
      ->assertSessionHasErrors("name");
  }

  public function test_create_existent_genre(): void
  {
    $data = [
      "name" => "Moda"
    ];
    $array = [
      'message' => 'El género ya existe'
    ];
    $this->post(route("generos.store"), $data)
      ->assertRedirect(route("generos.index"));

    $this->expectException(\Illuminate\Database\QueryException::class);
    $this->post(route("generos.store"), $data)
      ->assertJson($array)
      ->assertStatus(409);
  }
}
