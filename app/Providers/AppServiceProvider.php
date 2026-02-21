<?php

namespace App\Providers;

use App\Helpers\ThemeHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Define the helper function here if it doesn't exist
        if (!function_exists('theme_setting')) {
            function theme_setting(string $key, $default = null)
            {
                return ThemeHelper::get($key, $default);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}