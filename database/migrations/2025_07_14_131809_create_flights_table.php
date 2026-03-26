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
        Schema::create('flights', function (Blueprint $table) {
    $table->id();
    $table->string('airline');
    $table->string('flight_number')->unique();
    $table->string('from_location');
    $table->string('to_location');
    $table->date('departure_date');
    $table->time('departure_time');
    $table->date('arrival_date');
    $table->time('arrival_time');
    $table->integer('seat_capacity');
    $table->decimal('price', 10, 2);
    $table->text('description')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
