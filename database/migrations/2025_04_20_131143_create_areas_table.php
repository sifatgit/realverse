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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // e.g., "Block C", "Sector 12", "Bashundhara"
            $table->string('slug')->unique()->nullable();               // e.g., "block-c"
            $table->string('code')->nullable();             // Optional identifier

            $table->foreignId('city_id')
                  ->constrained()
                  ->onDelete('cascade'); // This is the key par         // FK to cities table
            $table->text('description')->nullable();        // Area description
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->text('google_map_location')->nullable(); // Google Maps link or iframe embed
            $table->integer('priority')->default(0);        // Sort order            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
