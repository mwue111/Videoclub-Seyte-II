<?php

namespace Tests\Feature\Http\Controllers\MovieController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

use App\Models\Movie;

class DestroyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_deletes_a_movie(): void
    {
        $movie = Movie::factory()->create([
            'updated_at'=> Carbon::now()->timestamp,
            'created_at'=> Carbon::now()->timestamp
        ]);

        $this->delete(route('peliculas.destroy', $movie))
            ->assertRedirect(route('peliculas.index'));

        $this->assertDatabaseMissing('movies', $movie->toArray());
    }
}
