<?php

use Illuminate\Support\Facades\Route;

/**
 * Web Routes
 */

Route::controller(\App\Http\Controllers\MainController::class)->group(function () {
    Route::get('/', 'index')->name('main.index');
    Route::get('/about', 'about')->name('main.about');
    Route::get('/certificates', 'certificates')->name('main.certificates');
    Route::get('/contacts', 'contacts')->name('main.contacts');
    Route::get('/privacy', 'privacy')->name('main.privacy');
    Route::get('/gallery', 'gallery')->name('main.gallery');
    Route::get('/agreement', 'agreement')->name('main.agreement');
});

Route::controller(\App\Http\Controllers\ReviewController::class)->group(function () {
    Route::get('/reviews', 'index')->name('reviews.index');
});

Route::controller(\App\Http\Controllers\ServiceController::class)->group(function () {
    Route::get('/services', 'services')->name('services');
    Route::get('/{slug}', 'show')->name('services.show');
});
