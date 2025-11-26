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
      Schema::create('payments', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignUuid('booking_id')->constrained('bookings')->cascadeOnUpdate();
        $table->decimal('amount',10,2);
        $table->enum('payment_method',['card','upi','netbanking','wallet'])->default('card');
        $table->enum('status',['success','failed','pending'])->default('pending');
        $table->timestamp('payment_date')->useCurrent();
        $table->timestamps();
        $table->softDeletes();
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
