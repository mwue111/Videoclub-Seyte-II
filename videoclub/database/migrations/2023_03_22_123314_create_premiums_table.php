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
    Schema::create('premiums', function (Blueprint $table) {
      $table->foreignId('user_id')->constrained()->primary();
      $table->timestamps();
      $table->date('payment_date');
      $table->softDeletes('deleted_at');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('premiums');
  }
};
