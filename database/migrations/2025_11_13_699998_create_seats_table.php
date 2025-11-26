<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('seats', function (Blueprint $table) {
      $table->id();
      $table->foreignId('layout_id')->constrained('seat_layouts')->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreignId('seat_type_id')->constrained('seat_types')->cascadeOnUpdate();
      $table->string('seat_number');
      $table->integer('seat_position_row');
      $table->integer('seat_position_col');
      $table->enum('status',['active','inactive'])->default('active');
      $table->enum('gender_restriction',['none','male','female'])->default('none');
      $table->timestamps();
    });

  }

  public function down(): void
  {
    Schema::dropIfExists('seats');
  }
};
