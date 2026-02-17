<?php

namespace App\Helpers;

use App\Models\ThemeSetting;
use Illuminate\Support\Facades\Cache;

class ThemeHelper
{
    /**
     * Cache key for theme settings
     */
    const CACHE_KEY = 'theme_settings';

    /**
     * Cache duration in seconds (1 week)
     */
    const CACHE_DURATION = 604800;

    /**
     * Get all theme settings grouped by key
     */
    public static function getAllSettings(): array
    {
        return Cache::remember(self::CACHE_KEY . '_all', self::CACHE_DURATION, function () {
            return ThemeSetting::all()
                ->mapWithKeys(function ($item) {
                    return [$item->key => self::castValue($item)];
                })
                ->toArray();
        });
    }

    /**
     * Get a theme setting by key with optional default value
     */
    public static function get(string $key, $default = null)
    {
        try {
            $settings = self::getAllSettings();
            return $settings[$key] ?? $default;
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * Cast value based on type
     */
    private static function castValue($item)
    {
        return match($item->type) {
            'boolean' => (bool) $item->value,
            'integer' => (int) $item->value,
            'json' => json_decode($item->value, true),
            default => $item->value
        };
    }

    /**
     * Clear the theme settings cache
     */
    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY . '_all');
    }
}

// Define the helper function in the global namespace
if (!function_exists('theme_setting')) {
    function theme_setting(string $key, $default = null)
    {
        return \App\Helpers\ThemeHelper::get($key, $default);
    }
}