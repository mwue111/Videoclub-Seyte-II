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

    public function test_it_saves_the_data() {

        $data = $this->validFields();

        $this->post(route('peliculas.store'), $data)
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabasehas('movies', $data);
    }

    public function test_it_requires_a_title() {

        $this->saveMovie(['title' => ''])
            ->assertSessionHasErrors('title');

    }

    public function test_it_requires_a_year() {

        $this->saveMovie(['year' => ''])
            ->assertSessionHasErrors('year');

    }

    public function test_it_requires_a_runtime() {

        $this->saveMovie(['runtime' => ''])
            ->assertSessionHasErrors('runtime');

    }

    public function test_it_requires_a_plot () {

        $this->saveMovie(['plot' => ''])
            ->assertSessionHasErrors('plot');

        }

    public function test_it_requires_a_genre () {

        $this->saveMovie(['genre' => ''])
            ->assertSessionHasErrors('genre');

    }

    public function test_it_requires_a_director () {

        $this->saveMovie(['director' => ''])
            ->assertSessionHasErrors('director');
    }

    public function saveMovie($data = []) {

        $this->withExceptionHandling();

        return $this->post(route('peliculas.store'), $this->validFields($data));

    }

    public function validFields($overrides = []): array {
        return array_merge([
            'title' => 'Película de prueba',
            'year' => 2000,
            'runtime' => 160,
            'plot' => 'sinopsis de una película de prueba',
            'genre' => 'drama',
            'director' => 'Alice Guy',
        ], $overrides);
    }

}
