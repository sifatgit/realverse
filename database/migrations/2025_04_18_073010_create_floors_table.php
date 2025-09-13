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
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                  ->constrained()
                  ->onDelete('cascade');           
            $table->unsignedInteger('floor');   // Example: 1, 2, 3...
            $table->string('label')->nullable();       // Optional label like "Ground Floor", "Penthouse"
            $table->unsignedInteger('units')->default(1); // Total units on this floor            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floors');
    }
};
