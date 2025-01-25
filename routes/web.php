<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\MainController::class)->group(function () {
    Route::get('/', 'index')->name('main.index');
    Route::get('/about', 'about')->name('main.about');
    Route::get('/certificates', 'certificates')->name('main.certificates');
    Route::get('/contacts', 'contacts')->name('main.contacts');
});

Route::controller(\App\Http\Controllers\ServiceController::class)->group(function () {
    Route::get('/services', 'services')->name('main.services');
    Route::get('/services/{slug}', 'show')->name('main.service');
});
