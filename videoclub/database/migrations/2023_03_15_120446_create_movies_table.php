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
    Schema::create('movies', function (Blueprint $table) {
      $table->id();
      $table->string('title', 200);
      $table->integer('year');
      $table->float('runtime');
      $table->string('plot', 5000);
      $table->string('director', 200);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('movies');
  }
};
