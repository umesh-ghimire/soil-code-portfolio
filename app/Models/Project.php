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
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'project_url',
        'github_url',
        'technologies',
        'is_featured',
        'sort_order',
        'is_published',
        'project_date',
        'client',
        'role',
        'gallery'
    ];

    protected $casts = [
        'technologies' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
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
     * Get the featured image URL
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image 
            ? asset('storage/' . $this->featured_image) 
            : null;
    }

    // Optional
    public function getTechnologyCountAttribute(): int
    {
        return count($this->technologies ?? []);
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
    }
}