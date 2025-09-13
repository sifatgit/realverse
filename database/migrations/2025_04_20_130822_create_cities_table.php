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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');                        // e.g., "Mirpur", "Uttara"
            $table->string('slug')->unique()->nullable();              // e.g., "mirpur"
            $table->string('code')->nullable();            // Optional short code
            $table->foreignId('state_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->text('description')->nullable();       // Optional city description
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->text('google_map_location')->nullable(); // Google Maps link or iframe embed

            $table->integer('priority')->default(0);       // Sorting/display order            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
