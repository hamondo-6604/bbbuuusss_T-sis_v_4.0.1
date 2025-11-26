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
      Schema::create('schedules', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignId('bus_id')->constrained('buses')->cascadeOnUpdate();
        $table->foreignId('route_id')->constrained('routes')->cascadeOnUpdate();
        $table->foreignId('departure_terminal_id')->constrained('terminals')->cascadeOnUpdate();
        $table->foreignId('arrival_terminal_id')->constrained('terminals')->cascadeOnUpdate();
        $table->dateTime('departure_time');
        $table->dateTime('arrival_time');
        $table->enum('status',['active','cancelled','completed'])->default('active');
        $table->timestamps();
        $table->softDeletes();
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
