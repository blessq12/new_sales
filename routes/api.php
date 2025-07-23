<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserRequestController;
use App\Facades\YandexFeed;
use App\Models\QrCode;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::get('/services', [ServiceController::class, 'list']);
Route::get('/search', [SearchController::class, 'search']);
Route::get('/search/news', [SearchController::class, 'searchNews']);
Route::controller(ReviewController::class)->prefix('reviews')->group(function () {
    Route::post('/store', 'store');
});

Route::controller(UserRequestController::class)->group(function () {
    Route::post('/user-requests/contact-form', 'contactForm');
    Route::post('/user-requests/store', 'store');
});

Route::controller(\App\Http\Controllers\NotificationController::class)->prefix('notifications')->group(function () {
    Route::post('/send-parts-request', 'sendPartsRequest');
});

Route::controller(\App\Http\Controllers\Api\TelegramWebhookController::class)->prefix('telegram')->group(function () {
    Route::post('/webhook', 'webhookHandler');
});

Route::get('/get-link/{id}', function ($id) {
    $qrCode = QrCode::findOrFail($id);

    if (!$qrCode->status) {
        abort(404);
    }

    return redirect($qrCode->qr_link);
});

Route::prefix('chatbot')->group(function () {
    Route::get('start', [App\Http\Controllers\Api\ChatbotController::class, 'start']);
    Route::post('answer', [App\Http\Controllers\Api\ChatbotController::class, 'answer']);
});
