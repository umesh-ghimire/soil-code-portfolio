<?php

namespace App\View\Composers;

use App\Helpers\ThemeHelper;
use Illuminate\View\View;

class ThemeSettingsComposer
{
    /**
     * Bind data to the view
     */
    public function compose(View $view): void
    {
        try {
            $view->with('themeSettings', ThemeHelper::getAllSettings());
        } catch (\Exception $e) {
            $view->with('themeSettings', []);
        }
    }
}