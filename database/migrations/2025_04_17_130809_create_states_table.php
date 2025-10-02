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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');                      // e.g., "Dhaka"
            $table->string('slug')->unique()->nullable();            // e.g., "dhaka"
            $table->string('code')->nullable();          // e.g., "DHK"

            $table->text('description')->nullable();     // Optional description for SEO/admin
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            
            $table->text('google_map_location')->nullable(); // Google Maps embed URL or share link

            //$table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0);     // Sorting order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
