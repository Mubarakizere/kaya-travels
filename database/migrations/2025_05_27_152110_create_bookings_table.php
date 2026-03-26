<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('trip_id')->constrained()->onDelete('cascade');
        $table->string('full_name');
        $table->string('email')->nullable();
        $table->string('phone');
        $table->date('travel_date')->nullable();
        $table->integer('guests')->default(1);
        $table->string('status')->default('pending'); // pending | approved | declined
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
