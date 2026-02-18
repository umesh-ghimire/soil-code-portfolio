<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\LegalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Route
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Experience Route
Route::get('/experience', [ExperienceController::class, 'index'])->name('experience');

// Skills Route
Route::get('/skills', [SkillsController::class, 'index'])->name('skills');

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

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
    Route::get('/success', [ContactController::class, 'success'])->name('success'); // ADD THIS LINE
});

// Legal Routes (Privacy, Terms, Cookie, Disclaimer)
Route::prefix('legal')->name('legal.')->group(function () {
    Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
    Route::get('/cookie', [LegalController::class, 'cookie'])->name('cookie');
    Route::get('/disclaimer', [LegalController::class, 'disclaimer'])->name('disclaimer');
});

// Newsletter Route
Route::post('/newsletter', [ContactController::class, 'newsletter'])->name('newsletter');

// Fallback Route
Route::fallback(function () {
    return redirect()->route('home');
});


Route::post('/admin/contact-reply/{id}', [ContactController::class, 'adminReply'])->name('admin.contact.reply');


