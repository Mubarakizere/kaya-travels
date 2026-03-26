<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('destinations', function (Blueprint $table) {
            // Only add these if not already in the table
            if (!Schema::hasColumn('destinations', 'image')) {
                $table->string('image')->nullable()->after('slug');
            }

            if (!Schema::hasColumn('destinations', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('image');
            }

            // DO NOT re-add description or type if they already exist
        });
    }

    public function down(): void {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['image', 'is_featured']);
        });
    }
};
