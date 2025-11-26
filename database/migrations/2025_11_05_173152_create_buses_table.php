<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('buses', function (Blueprint $table) {
      $table->id();
      $table->string('bus_number')->unique();                   // registration or bus number
      $table->string('bus_name')->nullable();                  // new: friendly bus name
      $table->string('bus_img')->nullable();                   // new: image path/URL
      $table->foreignId('bus_type_id')->constrained('bus_types')->cascadeOnUpdate();
      $table->foreignId('layout_id')->constrained('seat_layouts')->cascadeOnUpdate();
      $table->integer('capacity');
      $table->text('description')->nullable();                 // new: optional description
      $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
      $table->timestamps();
      $table->softDeletes();
    });

  }

  public function down(): void
  {
    Schema::dropIfExists('buses');
  }
};
