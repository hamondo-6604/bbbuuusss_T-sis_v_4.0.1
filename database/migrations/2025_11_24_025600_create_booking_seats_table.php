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
      Schema::create('booking_seats', function (Blueprint $table) {
        $table->id();
        $table->foreignUuid('booking_id')->constrained('bookings')->cascadeOnDelete();
        $table->foreignId('seat_id')->constrained('seats')->cascadeOnUpdate();
        $table->enum('status',['booked','cancelled'])->default('booked');
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_seats');
    }
};
