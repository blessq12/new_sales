<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function sendPartsRequest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'article' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:255',
            'file' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = rand() . $file->getClientOriginalName();
            $file->move(public_path('uploads/parts'), $fileName);
            $filePath = public_path('uploads/parts/' . $fileName);
            (new \App\Services\Telegram\TelegramMessageService())->sendPhoto([
                '🔍 Запрос на поиск запчасти от: ' . $validated['name'],
                '📞 Телефон: ' . $validated['phone'],
                '📝 Артикул: ' . $validated['article'],
                '📝 Сообщение: ' . $validated['message'],
            ], $filePath, 'order');
        } else {
            (new \App\Services\Telegram\TelegramMessageService())->sendMessage([
                '🔍 Запрос на поиск запчасти ',
                '👤 Имя: ' . $validated['name'],
                '📞 Телефон: ' . $validated['phone'],
                '📝 Артикул: ' . $validated['article'],
                '📝 Сообщение: ' . $validated['message'],
            ], 'order');
        }

        return response()->json([
            'message' => 'Запрос на поиск запчасти отправлен!',
            'file' => $fileName ?? null,
        ], 200);
    }
}
