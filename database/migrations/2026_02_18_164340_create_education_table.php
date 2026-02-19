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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('degree');                    // e.g., "Bachelor of Science"
            $table->string('field_of_study')->nullable(); // e.g., "Computer Science"
            $table->string('institution');                // e.g., "Kathmandu University"
            $table->string('location')->nullable();       // e.g., "Lalitpur, Nepal"
            
            // Dates
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            
            // Details
            $table->text('description')->nullable();      // Full description
            $table->string('grade')->nullable();          // e.g., "3.8 GPA", "First Class", "75%"
            $table->json('achievements')->nullable();     // JSON array of achievements
            
            // Sorting and Publishing
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('start_date');
            $table->index('is_published');
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};