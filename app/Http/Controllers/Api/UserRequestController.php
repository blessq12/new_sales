<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRequest;

class UserRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $data = $request->data;

        $userRequest = UserRequest::create([
            'type' => $request->type,
            'data' => $data
        ]);

        if (!$userRequest->save()) {
            return response()->json([
                'message' => 'Произошла ошибка при сохранении данных',
            ], 500);
        }

        $messageHeaderData = [
            '👤 Новый запрос на услугу',
            '🔍 Тип: ' . $request->type,
        ];

        $messageData = [
            isset($data['name']) ? 'Имя: ' . $data['name'] : null,
            isset($data['phone']) ? 'Телефон: ' . $data['phone'] : null,
            isset($data['agree']) ? 'Согласие на обработку: ' . ($data['agree'] == true ? 'Да' : 'Нет') : null,
            isset($data['comment']) ? 'Сообщение: ' . $data['comment'] : null,
            isset($data['message']) ? 'Сообщение: ' . $data['message'] : null,
            isset($data['service_name']) ? 'Услуга: ' . $data['service_name'] : null,
        ];

        $messageData = array_filter($messageData);

        (new \App\Services\Telegram\TelegramMessageService())->sendMessage(
            array_merge($messageHeaderData, $messageData),
            'contact'
        );

        return response()->json([
            'message' => 'Запрос успешно зарегистрирован',
        ]);
    }

    public function contactForm(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'data' => 'required',
            'data.name' => 'required',
            'data.phone' => 'required',
            'data.email' => 'required',
            'data.message' => 'required',
            'data.subject' => 'required',
        ]);

        $data = $request->data;

        $userRequest = UserRequest::create([
            'type' => $request->type,
            'data' => $data
        ]);


        if (!$userRequest->save()) {
            return response()->json([
                'message' => 'Произошла ошибка при сохранении данных',
            ], 500);
        }


        $messageHeaderData = [
            '👤 Новый запрос на обратную связь',
            'Страница: Контакты',
            '🔍 Тип: ' . $request->type . "\n",
        ];

        $messageData = [
            isset($data['name']) ? 'Имя: ' . $data['name'] : null,
            isset($data['phone']) ? 'Телефон: ' . $data['phone'] : null,
            isset($data['email']) ? 'Email: ' . $data['email'] : null,
            isset($data['message']) ? 'Сообщение: ' . $data['message'] : null,
            isset($data['subject']) ? 'Тема: ' . $data['subject'] : null,
        ];

        (new \App\Services\Telegram\TelegramMessageService())->sendMessage(
            array_merge($messageHeaderData, $messageData),
            'order'
        );

        return response()->json([
            'message' => 'Запрос успешно зарегистрирован',
        ]);
    }
}
