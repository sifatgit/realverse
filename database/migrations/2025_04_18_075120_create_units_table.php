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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                  ->constrained()
                  ->onDelete('cascade'); 
            $table->foreignId('floor_id')
                  ->constrained()
                  ->onDelete('cascade');                 // Reference to floors                                      
            $table->string('number');              // Unique unit number like A1, 101, etc.
            $table->longText('image_path'); // Path or URL to the image file
            $table->string('video_path')->nullable(); // Local path or YouTube/Vimeo/embed URL
            $table->string('pdf_path')->nullable(); // Path or URL to the image file
            $table->unsignedInteger('living_room')->default(1);
            $table->unsignedInteger('dining_room')->default(1);
            $table->unsignedInteger('bedrooms')->default(1);
            $table->unsignedInteger('bathrooms')->default(1);
            $table->unsignedInteger('balconies')->default(1);
            $table->integer('area_sqft'); // Specific unit area
            $table->boolean('is_sold')->default(false);      // Sell status
            $table->enum('status', [ 'complete', 'under_construction'])->default('complete');
            $table->integer('price');     // Unit price
            //$table->json('features')->nullable();            // Optional features (AC, parking, etc.)
            $table->date('handover_date');                     // Handover Date
            $table->string('payment_plan');                    // e.g., "24 months", "Instantly"
            $table->string('latitude')->nullable();                // Latitude
            $table->string('longitude')->nullable();               // Longitude
            $table->text('view')->nullable();
            $table->enum('direction', ['north', 'south', 'east', 'west', 'north-south', 'east-west', 'south-west', 'north-east'])->nullable(); // Facing Direction
            $table->date('build_date')->nullable();                      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
