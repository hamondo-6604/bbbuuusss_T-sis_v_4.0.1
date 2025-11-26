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
      Schema::create('route_stops', function (Blueprint $table) {
        $table->id();
        $table->foreignId('route_id')->constrained('routes')->cascadeOnDelete()->cascadeOnUpdate();
        $table->foreignId('stop_id')->constrained('stops')->cascadeOnUpdate();
        $table->integer('stop_order');                     // order along the route
        $table->decimal('distance_from_origin',6,2);
        $table->integer('estimated_time_min');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        $table->unique(['route_id','stop_order']);
        $table->unique(['route_id','stop_id']);
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_stop');
    }
};
