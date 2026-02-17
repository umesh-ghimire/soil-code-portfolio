<?php

namespace App\Providers;

use App\Helpers\ThemeHelper;
use App\View\Composers\ThemeSettingsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ThemeHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */
    public function register(): void
    {
        $this->app->singleton(ThemeHelper::class, function ($app) {
            return new ThemeHelper();
        });
    }

    /**
     * Bootstrap services
     */
    public function boot(): void
    {
        // Load the helper file
        if (file_exists($helperFile = app_path('Helpers/ThemeHelper.php'))) {
            require_once $helperFile;
        }
        
        // Register view composer
        View::composer('*', function ($view) {
            try {
                $view->with('themeSettings', ThemeHelper::getAllSettings());
            } catch (\Exception $e) {
                $view->with('themeSettings', []);
            }
        });
    }
}