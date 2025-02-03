<?php

use Illuminate\Support\Facades\Route;
use App\Facades\Telegram;

Route::controller(\App\Http\Controllers\MainController::class)->group(function () {
    Route::get('/', 'index')->name('main.index');
    Route::get('/about', 'about')->name('main.about');
    Route::get('/certificates', 'certificates')->name('main.certificates');
    Route::get('/contacts', 'contacts')->name('main.contacts');
    Route::get('/privacy', 'privacy')->name('main.privacy');
    Route::get('/cooperation', 'cooperation')->name('main.cooperation');
});

Route::controller(\App\Http\Controllers\ServiceController::class)->group(function () {
    Route::get('/services', 'services')->name('services');
    Route::get('/services/{slug}', 'show')->name('services.show');
});

Route::prefix('api')->group(function () {
    require __DIR__ . '/api.php';
});
