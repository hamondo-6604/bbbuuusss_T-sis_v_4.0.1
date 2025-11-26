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
    Schema::create('routes', function (Blueprint $table) {
      $table->id();
      $table->foreignId('origin_terminal_id')->constrained('terminals')->cascadeOnUpdate();
      $table->foreignId('destination_terminal_id')->constrained('terminals')->cascadeOnUpdate();
      $table->text('via')->nullable();
      $table->decimal('distance_km', 8,2);
      $table->integer('duration_min');
      $table->boolean('is_active')->default(true);
      $table->timestamps();
      $table->unique(['origin_terminal_id','destination_terminal_id']);
    });

  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('routes');
  }
};
