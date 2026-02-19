<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'degree',
        'field_of_study',
        'institution',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'grade',
        'achievements',
        'sort_order',
        'is_published'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'is_published' => 'boolean',
        'achievements' => 'array',
        'sort_order' => 'integer',
        
    ];

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
     * Get formatted degree with field of study
     */
    public function getFullDegreeAttribute(): string
    {
        if ($this->field_of_study) {
            return "{$this->degree} in {$this->field_of_study}";
        }
        
        return $this->degree;
    }

    
}