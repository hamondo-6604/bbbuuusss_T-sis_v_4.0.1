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
      $table->uuid('id')->primary();
      $table->foreignUuid('user_id')->constrained('users')->cascadeOnUpdate();
      $table->foreignUuid('schedule_id')->constrained('schedules')->cascadeOnUpdate();
      $table->timestamp('booking_date')->useCurrent();
      $table->enum('status',['confirmed','pending','cancelled'])->default('pending');
      $table->decimal('total_amount',10,2);
      $table->timestamps();
      $table->softDeletes();
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
