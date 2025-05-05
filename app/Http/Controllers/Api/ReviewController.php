<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
            'agree_to_process_personal_data' => 'required|boolean'
        ]);

        $review = Review::create($request->all());

        if (!$review->save()) {
            return response()->json(['error' => 'Failed to save review'], 500);
        }

        (new \App\Services\Telegram\TelegramMessageService())->sendMessage([
            '👤 Новый отзыв от: ' . $review->name . "\n",

            'Услуга: ' . $review->service->name,
            '🌟 Оценка: ' . $review->rating,
            '📝 Сообщение: ' . $review->message,
        ], 'event');

        return response()->json($review);
    }
}
