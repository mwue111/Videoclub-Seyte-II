<?php

namespace Tests\Feature\Http\Controllers\MovieController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_shows_the_create_form(): void
    {
        $this->get(route('peliculas.create'))
            ->assertStatus(200)
            ->assertSee(route('peliculas.store'))
            ->assertSee(route('peliculas.index'));
    }
}
