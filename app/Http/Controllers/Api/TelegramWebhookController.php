<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TelegramChat;

class TelegramWebhookController extends Controller
{
    private $updateId;
    private $chatId;
    private $userId;
    private $userFirstName;
    private $userLastName;
    private $username;
    private $messageId;
    private $messageText;
    private $isCommand;
    private $callbackData;
    private $inlineQuery;
    private $chatType;
    private $entities;
    private $media;
    private $blacklistedChatIds = [123456, 789012];

    public function webhookHandler(Request $request)
    {
        $data = $request->all();

        $this->updateId = $data['update_id'] ?? null;
        $this->chatId = $data['message']['chat']['id'] ?? $data['callback_query']['message']['chat']['id'] ?? $data['inline_query']['chat']['id'] ?? null;
        $this->userId = $data['message']['from']['id'] ?? $data['callback_query']['from']['id'] ?? $data['inline_query']['from']['id'] ?? null;
        $this->userFirstName = $data['message']['from']['first_name'] ?? $data['callback_query']['from']['first_name'] ?? $data['inline_query']['from']['first_name'] ?? 'друг';
        $this->userLastName = $data['message']['from']['last_name'] ?? $data['callback_query']['from']['last_name'] ?? $data['inline_query']['from']['last_name'] ?? null;
        $this->username = $data['message']['from']['username'] ?? $data['callback_query']['from']['username'] ?? $data['inline_query']['from']['username'] ?? null;
        $this->messageId = $data['message']['message_id'] ?? $data['callback_query']['message']['message_id'] ?? null;
        $this->messageText = $data['message']['text'] ?? null;
        $this->isCommand = $this->messageText && str_starts_with($this->messageText, '/');
        $this->callbackData = $data['callback_query']['data'] ?? null;
        $this->inlineQuery = $data['inline_query']['query'] ?? null;
        $this->chatType = $data['message']['chat']['type'] ?? $data['callback_query']['message']['chat']['type'] ?? null;
        $this->entities = $data['message']['entities'] ?? null;
        $this->media = $this->parseMedia($data['message'] ?? []);

        if (in_array($this->chatId, $this->blacklistedChatIds)) {
            return;
        }

        $this->storeChat();

        if ($this->callbackData) {
            $this->handleCallback($this->callbackData);
        } elseif ($this->inlineQuery) {
            $this->handleInlineQuery($this->inlineQuery);
        } elseif ($this->isCommand) {
            $this->handleCommand($this->messageText);
        } elseif ($this->messageText || $this->media) {
            $this->handleMessage($this->messageText);
        }
    }

    private function parseMedia(array $message): ?array
    {
        $media = [];
        if (isset($message['photo'])) $media['photo'] = $message['photo'];
        if (isset($message['video'])) $media['video'] = $message['video'];
        if (isset($message['document'])) $media['document'] = $message['document'];
        if (isset($message['sticker'])) $media['sticker'] = $message['sticker'];
        if (isset($message['voice'])) $media['voice'] = $message['voice'];
        return !empty($media) ? $media : null;
    }

    private function storeChat()
    {
        TelegramChat::updateOrCreate(
            ['chat_id' => $this->chatId],
            [
                'user_id' => $this->userId,
                'first_name' => $this->userFirstName,
                'last_name' => $this->userLastName,
                'username' => $this->username,
                'chat_type' => $this->chatType,
                'last_message' => $this->messageText,
                'last_message_id' => $this->messageId,
                'media' => $this->media ? json_encode($this->media) : null,
                'entities' => $this->entities ? json_encode($this->entities) : null,
                'updated_at' => now()
            ]
        );
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
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            ["Привет, {$this->userFirstName}! Чем могу помочь?"],
            $this->chatId
        );
    }

    private function handleDefaultCommand()
    {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            'Не знаю такой команды, попробуй /start.',
            $this->chatId
        );
    }

    private function handleMessage($message)
    {
        $response = $this->media
            ? "Получил медиа, {$this->userFirstName}! Пока не знаю, что с этим делать."
            : "Эй, {$this->userFirstName}, я пока не умею отвечать на обычные сообщения.";
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId
        );
    }

    private function handleCallback($callbackData)
    {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            "Получен callback, {$this->userFirstName}: $callbackData",
            $this->chatId
        );
    }

    private function handleInlineQuery($query)
    {
        // Здесь можно добавить логику для ответа на инлайн-запросы
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            "Инлайн-запрос от {$this->userFirstName}: $query",
            $this->chatId
        );
    }
}
