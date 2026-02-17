<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Experience extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'company',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'achievements',
        'technologies',
        'company_logo',
        'sort_order',
        'is_published'
    ];

    protected $casts = [
        'achievements' => 'array',
        'technologies' => 'array',
        'is_current' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    /**
     * Scope a query to only published experiences
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to order by date (most recent first)
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('start_date', 'desc');
    }

    /**
     * Get the duration in a readable format
     */
    public function getDurationAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        
        if ($this->is_current) {
            return "{$start} - Present";
        }
        
        $end = $this->end_date ? $this->end_date->format('M Y') : 'Present';
        return "{$start} - {$end}";
    }

    /**
     * Calculate total months
     */
    public function getTotalMonthsAttribute(): int
    {
        $end = $this->end_date ?? now();
        return $this->start_date->diffInMonths($end);
    }
}