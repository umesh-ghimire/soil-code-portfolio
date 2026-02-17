<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;

use function App\Helpers\theme_setting;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Project Routes
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProjectController::class, 'show'])->name('show');
});

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/category/{category}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{tag}', [BlogController::class, 'tag'])->name('tag');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// Contact Routes
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// Newsletter Route
Route::post('/newsletter', [ContactController::class, 'newsletter'])->name('newsletter');

// Fallback Route
Route::fallback(function () {
    return redirect()->route('home');
});

Route::get('/test-helper', function() {
    return response()->json([
        'function_exists' => function_exists('theme_setting'),
        'test_value' => theme_setting('hero_greeting', 'default'),
    ]);
});

Route::get('/test-helper', function() {
    return response()->json([
        'function_exists' => function_exists('theme_setting'),
        'test_call' => theme_setting('hero_greeting', 'default value'),
        'all_settings' => \App\Helpers\ThemeHelper::getAllSettings(),
        'loaded_files' => array_values(array_filter(get_included_files(), function($file) {
            return str_contains($file, 'Helper');
        }))
    ]);
});