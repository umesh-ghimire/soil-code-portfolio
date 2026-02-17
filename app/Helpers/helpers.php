<?php

if (!function_exists('theme_setting')) {
    /**
     * Get a theme setting value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function theme_setting(string $key, $default = null)
    {
        return \App\Helpers\ThemeHelper::get($key, $default);
    }
}