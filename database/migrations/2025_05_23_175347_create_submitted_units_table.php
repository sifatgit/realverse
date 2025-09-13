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
        Schema::create('submitted_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade');
            $table->foreignId('state_id')
                    ->constrained()
                    ->onDelete('cascade');
            $table->foreignId('city_id')
                    ->constrained()
                    ->onDelete('cascade');
            $table->foreignId('area_id')
                    ->constrained()
                    ->onDelete('cascade');                                         
            $table->string('user_photo')->nullable();
            $table->string('number');            
            $table->unsignedInteger('floor');                // Reference to floors                                      
            $table->string('image_path'); // Path or URL to the image file
            $table->string('video_path')->nullable(); // Local path or YouTube/Vimeo/embed URL
            $table->unsignedInteger('living_room');
            $table->unsignedInteger('dining_room');
            $table->unsignedInteger('bedrooms');
            $table->unsignedInteger('bathrooms');
            $table->unsignedInteger('balconies');
            $table->json('features')->nullable();            
            $table->integer('area_sqft'); // Specific unit area
            $table->enum('condition', [ 'new', 'used']);
            $table->enum('type', [ 'sell', 'rent']);
            $table->integer('price');     // Unit price
            $table->date('build_date');
            $table->text('description')->nullable();
            $table->string('phone');           
            $table->text('address');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submitted_units');
    }
};
