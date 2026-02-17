<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'category',
        'proficiency',
        'is_featured',
        'sort_order',
        'is_published'
    ];

    protected $casts = [
        'proficiency' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Scope a query to only published skills
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only featured skills
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope by category
     */
    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get all available categories
     */
    public static function getCategories(): array
    {
        return [
            'frontend' => 'Frontend',
            'backend' => 'Backend',
            'database' => 'Database',
            'devops' => 'DevOps',
            'tools' => 'Tools',
            'design' => 'Design',
            'soft' => 'Soft Skills'
        ];
    }
}