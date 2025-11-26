<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('seat_layouts', function (Blueprint $table) {
      $table->id();
      $table->string('layout_name');
      $table->integer('total_seats');
      $table->enum('deck_type',['single','double'])->default('single');
      $table->string('description')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('seat_layouts');
  }
};
