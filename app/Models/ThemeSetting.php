<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ThemeSetting extends Model
{
    protected $table = 'theme_settings';

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'sort_order'
    ];

    protected $casts = [
        'sort_order' => 'integer'
    ];

    /**
     * Boot the model and clear cache on save/delete
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('theme_settings_all');
            Cache::forget('theme_settings_grouped');
        });

        static::deleted(function () {
            Cache::forget('theme_settings_all');
            Cache::forget('theme_settings_grouped');
        });
    }

    /**
     * Get value with proper type casting
     */
    public function getTypedValueAttribute()
    {
        return match($this->type) {
            'boolean' => (bool) $this->value,
            'integer' => (int) $this->value,
            'json' => json_decode($this->value, true),
            default => $this->value
        };
    }

    /**
     * Scope by group
     */
    public function scopeGroup($query, string $group)
    {
        return $query->where('group', $group);
    }

    /**
     * Scope by key
     */
    public function scopeKey($query, string $key)
    {
        return $query->where('key', $key);
    }
}