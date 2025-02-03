<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ReviewController;

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

Route::controller(\App\Http\Controllers\Api\RawConntroller::class)->prefix('raw')->group(function () {
    Route::get('/get-services', 'getServices');
    Route::get('/get-company-data', 'getCompanyData');
});

Route::get('/services', [ServiceController::class, 'list']);
Route::post('/reviews', [ServiceController::class, 'storeReview']);

Route::get('/search', [SearchController::class, 'search']);

Route::post('/callback', function (Request $request) {
    return response()->json([
        'message' => 'Callback received',
        'data' => $request->all()
    ]);
});

Route::controller(ReviewController::class)->group(function () {
    Route::post('/reviews/store', 'store');
});
