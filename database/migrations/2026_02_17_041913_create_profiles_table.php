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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Umesh Ghimire');
            $table->string('title')->default('soil & code');
            $table->text('bio')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('location')->default('from the himalayas');
            $table->string('greeting')->default("Hi, I'm");
            $table->string('nepali_text')->default('माटो र माया');
            $table->string('profile_image')->nullable();
            $table->string('resume_file')->nullable();
            $table->integer('years_experience')->default(0);
            $table->integer('total_projects')->default(0);
            $table->integer('open_source_contributions')->default(0);
            
            // Social Links as JSON
            $table->json('social_links')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
