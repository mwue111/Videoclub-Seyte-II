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
    Schema::table('users', function (Blueprint $table) {
      $table->string('surname')->nullable();
      $table->string('image')->nullable();
      $table->date('birth_date');
      $table->enum('role', ['registered', 'admin', 'non-registered'])->default('non-registered');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('surname');
      $table->dropColumn('image');
      $table->dropColumn('birth_date');
    });
  }
};
