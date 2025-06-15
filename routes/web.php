<?php

use Illuminate\Support\Facades\Route;


include_once __DIR__ . '/redirects.php';

Route::controller(\App\Http\Controllers\MainController::class)->group(function () {
    Route::get('/', 'index')->name('main.index');
    Route::get('/about', 'about')->name('main.about');
    Route::get('/grohe-service', 'groheService')->name('main.groheService');
    Route::get('/contacts', 'contacts')->name('main.contacts');

    Route::get('/cooperation', 'cooperation')->name('main.cooperation');
    Route::get('/privacy', 'privacy')->name('main.privacy');
    Route::get('/gallery', 'gallery')->name('main.gallery');
    Route::get('/agreement', 'agreement')->name('main.agreement');
});

Route::controller(\App\Http\Controllers\ReviewController::class)->group(function () {
    Route::get('/reviews', 'index')->name('reviews.index');
});

Route::controller(\App\Http\Controllers\ServiceController::class)->group(function () {
    Route::get('/services', 'services')->name('services');
    Route::get('/services/price', 'price')->name('services.price');
    Route::get('/services/price/download', 'downloadPrice')->name('services.price.download');
    Route::get('/{category}/{slug}', 'show')->name('services.show');
    Route::get('/{category}', 'category')->name('services.category');
});
