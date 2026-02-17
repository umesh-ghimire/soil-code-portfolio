<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'position',
        'company',
        'content',
        'avatar',
        'rating',
        'is_featured',
        'sort_order',
        'is_published'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Scope a query to only published testimonials
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only featured testimonials
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get avatar URL
     */
    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar 
            ? asset('storage/' . $this->avatar) 
            : null;
    }

    /**
     * Get formatted rating as stars
     */
    public function getRatingStarsAttribute(): string
    {
        if (!$this->rating) {
            return '';
        }

        $full = str_repeat('★', $this->rating);
        $empty = str_repeat('☆', 5 - $this->rating);
        return $full . $empty;
    }
}