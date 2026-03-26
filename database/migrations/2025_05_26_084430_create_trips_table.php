<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->enum('category', ['adventure', 'cultural', 'luxury', 'weekend']);
            $table->string('location');
            $table->decimal('price', 10, 2);
            $table->string('duration'); // e.g. "3 Days / 2 Nights"
            $table->boolean('status')->default(true);
            $table->boolean('is_top')->default(false);
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->json('itinerary')->nullable();       // JSON array of days
            $table->json('inclusions')->nullable();      // JSON array of what's included
            $table->json('exclusions')->nullable();      // Optional
            $table->json('gallery')->nullable();         // JSON array of image paths
            $table->string('meta_title')->nullable();    // SEO
            $table->string('meta_description')->nullable(); // SEO
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('trips');
    }
};
