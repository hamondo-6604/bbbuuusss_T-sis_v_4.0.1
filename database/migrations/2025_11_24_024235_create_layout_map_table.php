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
      Schema::create('layout_map', function (Blueprint $table) {
        $table->id();
        $table->foreignId('layout_id')->constrained('seat_layouts')->cascadeOnUpdate()->cascadeOnDelete();
        $table->foreignId('seat_id')->nullable()->constrained('seats')->cascadeOnUpdate()->nullOnDelete();
        $table->integer('row_num');
        $table->integer('col_num');
        $table->boolean('is_aisle')->default(false);
        $table->boolean('is_disabled')->default(false);
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layout_map');
    }
};
