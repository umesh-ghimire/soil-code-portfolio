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
            
            // Basic Information
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('content')->nullable();
            
            // Media
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            
            // Links
            $table->string('project_url')->nullable();
            $table->string('github_url')->nullable();
            
            // Technologies
            $table->json('technologies')->nullable();
            
            // Project Details
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->date('project_date')->nullable();
            $table->string('client')->nullable();
            $table->string('role')->nullable();
            
            // ===== CASE STUDY FIELDS =====
            
            // Case study toggle
            $table->boolean('has_case_study')->default(false);
            
            // Case study content
            $table->string('case_study_title')->nullable();
            $table->longText('case_study_content')->nullable();
            
            // Challenge, Solution, Results
            $table->text('challenge')->nullable();
            $table->text('solution')->nullable();
            $table->text('results')->nullable();
            
            // Case study metadata
            $table->string('duration')->nullable();
            $table->string('team_size')->nullable();
            
            // Testimonial
            $table->text('testimonial')->nullable();
            $table->string('testimonial_author')->nullable();
            
            // Case study images
            $table->json('case_study_images')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('slug');
            $table->index('is_featured');
            $table->index('is_published');
            $table->index('sort_order');
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