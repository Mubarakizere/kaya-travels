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
        Schema::table('trips', function (Blueprint $table) {
    $table->unsignedBigInteger('destination_id')->nullable()->after('slug');
    $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('set null');
    $table->dropColumn('location'); // remove old location string
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            //
        });
    }
};
