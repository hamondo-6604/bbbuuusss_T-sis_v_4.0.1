<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seat_layouts', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('layout_name'); // e.g., "2x2"
            $table->integer('total_rows'); 
            $table->integer('total_columns');
            $table->integer('capacity'); // Optional, can be calculated manually or automatically
            $table->json('layout_map')->nullable(); // Optional JSON for seat arrangement
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('description')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seat_layouts');
    }
};
