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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            // Core Info
            $table->string('name');
            $table->string('code')->unique(); // e.g. RV-BLD-001
            $table->text('description')->nullable();
            $table->string('image');
            // Address
            $table->string('address_line');
            $table->foreignId('state_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('city_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('area_id')
                  ->constrained()
                  ->onDelete('cascade');           
            $table->string('postal_code');
            //$table->string('country')->default('Bangladesh');
            // Structure
            $table->unsignedInteger('floors')->default(1);
            $table->unsignedInteger('units')->default(1);
            $table->unsignedInteger('total_area_rounded_sqft');
            $table->unsignedInteger('total_building_area');
            $table->unsignedInteger('common_area');
            $table->unsignedInteger('net_area');

            // Ownership & Management
            //$table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            //$table->string('manager_name')->nullable();
            $table->string('contact')->nullable();

            // Status & Metadata
            $table->enum('status', [ 'complete', 'under_construction'])->default('complete');
            $table->json('features')->nullable(); // e.g. elevators, parking, rooftop, gym, swimming, waterfront
            $table->boolean('is_sold_out')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
