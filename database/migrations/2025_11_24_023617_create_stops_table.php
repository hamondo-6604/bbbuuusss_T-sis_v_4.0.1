<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('stops', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->foreignId('city_id')->constrained()->cascadeOnUpdate();
      $table->string('code')->nullable();
      $table->decimal('latitude', 9, 6)->nullable();
      $table->decimal('longitude', 9, 6)->nullable();
      $table->boolean('is_terminal')->default(false);
      $table->boolean('is_active')->default(true);
      $table->timestamps();
      $table->unique(['city_id', 'name']);
    });

  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('stops');
  }
};
