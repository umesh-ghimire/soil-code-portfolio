<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Case study fields
            $table->boolean('has_case_study')->default(false)->after('gallery');
            $table->string('case_study_title')->nullable()->after('has_case_study');
            $table->longText('case_study_content')->nullable()->after('case_study_title');
            $table->text('challenge')->nullable()->after('case_study_content');
            $table->text('solution')->nullable()->after('challenge');
            $table->text('results')->nullable()->after('solution');
            $table->string('duration')->nullable()->after('results');
            $table->string('team_size')->nullable()->after('duration');
            $table->text('testimonial')->nullable()->after('team_size');
            $table->string('testimonial_author')->nullable()->after('testimonial');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'has_case_study',
                'case_study_title',
                'case_study_content',
                'challenge',
                'solution',
                'results',
                'duration',
                'team_size',
                'testimonial',
                'testimonial_author'
            ]);
        });
    }
};