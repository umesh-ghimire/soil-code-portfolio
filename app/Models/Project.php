<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        // Basic Information
        'title',
        'slug',
        'description',
        'content',
        
        // Media
        'featured_image',
        'gallery',
        
        // Links
        'project_url',
        'github_url',
        
        // Technologies
        'technologies',
        
        // Project Details
        'is_featured',
        'sort_order',
        'is_published',
        'project_date',
        'client',
        'role',
        
        // Case Study Fields
        'has_case_study',
        'case_study_title',
        'case_study_content',
        'challenge',
        'solution',
        'results',
        'duration',
        'team_size',
        'testimonial',
        'testimonial_author',
        'case_study_images'
    ];

    protected $casts = [
        // JSON fields
        'technologies' => 'array',
        'gallery' => 'array',
        'case_study_images' => 'array',
        
        // Boolean fields
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'has_case_study' => 'boolean',
        
        // Integer fields
        'sort_order' => 'integer',
        
        // Date fields
        'project_date' => 'date'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Scope a query to only published projects
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only featured projects
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to projects with case studies
     */
    public function scopeHasCaseStudy($query)
    {
        return $query->where('has_case_study', true);
    }

    /**
     * Get the featured image URL
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image 
            ? asset('storage/' . $this->featured_image) 
            : null;
    }

    /**
     * Get case study URL
     */
    public function getCaseStudyUrlAttribute(): string
    {
        return route('projects.case-study', $this->slug);
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
        
        $this->addMediaCollection('case_study_images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }
}