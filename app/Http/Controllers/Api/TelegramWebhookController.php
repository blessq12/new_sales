<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TelegramWebhookController extends Controller
{
    private $chatId;

    public function webhook(Request $request)
    {
        $data = $request->all();

        $message = $data['message']['text'];
        $chatId = $data['message']['chat']['id'];
        if (str_starts_with($message, '/')) {
            $this->handleCommand($message);
        }
    }
    private function handleCommand($message)
    {
        $command = substr($message, 1);
        switch ($command) {
            case 'start':
                $this->handleStartCommand();
                break;
            default:
                $this->handleDefaultCommand();
                break;
        }
    }
    private function handleStartCommand()
    {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat('Привет! Я бот, который поможет тебе с заказами запчастей для сантехники GROHE.', $this->chatId);
    }
    private function handleDefaultCommand()
    {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat('Я не знаю этой команды. Пожалуйста, используйте /start для начала работы.', $this->chatId);
    }
}
