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
      Schema::create('terminals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('city_id')->constrained()->cascadeOnUpdate();
        $table->string('name');
        $table->string('code')->nullable();
        $table->string('address')->nullable();
        $table->decimal('latitude', 9,6)->nullable();
        $table->decimal('longitude', 9,6)->nullable();
        $table->string('contact_phone')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        $table->unique(['city_id','name']);
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terminals');
    }
};
