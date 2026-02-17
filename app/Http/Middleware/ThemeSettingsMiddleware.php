<?php

namespace App\Http\Middleware;

use App\Helpers\ThemeHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ThemeSettingsMiddleware
{
    /**
     * Handle an incoming request
     */
    public function handle(Request $request, Closure $next)
    {
        // Share theme settings with all views
        View::share('themeSettings', ThemeHelper::getAllSettings());
        
        return $next($request);
    }
}