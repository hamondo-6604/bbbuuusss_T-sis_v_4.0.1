<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();  // Primary key
            
            // Foreign keys
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('bus_id')
                  ->constrained('buses')
                  ->onDelete('cascade');
            $table->foreignId('route_id')
                  ->constrained('routes')
                  ->onDelete('cascade');

            // Optional additional foreign keys, comment out if you don't have these tables
            $table->foreignId('trip_id')->nullable()
                  ->constrained('trips')
                  ->onDelete('cascade');
            $table->foreignId('seat_id')->nullable()
                  ->constrained('seats')
                  ->onDelete('set null');
            
            // Booking details
            $table->string('seat_number')->nullable();
            $table->string('seat_type')->default('economy');
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])
                  ->default('pending');

            $table->timestamp('departure_time')->nullable();
            $table->timestamp('arrival_time')->nullable();

            // Payment details
            $table->decimal('amount_paid', 10, 2)->default(0.00);
            $table->string('payment_status')->default('unpaid');

            $table->string('booking_reference')->unique();

            $table->timestamp('cancelled_at')->nullable();

            // Laravel timestamps and soft deletes
            $table->timestamps();
            $table->softDeletes();

            // Indexes for optimization
            $table->index('status');
            $table->index('payment_status');
            $table->index('booking_reference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
