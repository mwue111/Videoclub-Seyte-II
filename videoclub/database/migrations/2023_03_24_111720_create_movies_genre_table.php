<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('movies_genre', function (Blueprint $table) {
      $table->timestamps();
      $table->foreignId('movie_id')->constrained()->primary();
      $table->foreignId('genre_id')->constrained()->primary();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('movies_genre');
  }
};
