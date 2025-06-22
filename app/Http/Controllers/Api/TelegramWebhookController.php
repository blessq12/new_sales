<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TelegramChat;
use Illuminate\Support\Facades\Log;

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
    private $blacklistedChatIds = [-1002449128308];

    protected $keyboard = [
        'keyboard' => [
            [['text' => 'О компании 📄'], ['text' => 'Контакты 📩']],
            [['text' => 'Услуги и цены 💰'], ['text' => 'Оставить заявку 📝']],
            [['text' => 'Выезд и стоимость 🚗'], ['text' => 'Зоны обслуживания 📍']],
            [['text' => 'Grohe Сервис 🔧']]
        ],
        'resize_keyboard' => true,
        'one_time_keyboard' => false
    ];

    public function webhookHandler(Request $request)
    {
        $data = $request->all();
        Log::debug('Telegram Webhook Data: ', $data);
        $this->updateId = $data['update_id'] ?? null;
        $this->chatId = $this->extractChatId($data);
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

        if (!$this->chatId) {
            Log::error('Chat ID is null, skipping processing.', ['data' => $data]);
            return;
        }

        if (in_array($this->chatId, $this->blacklistedChatIds)) {
            Log::info('Chat ID in blacklist: ' . $this->chatId);
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

    private function extractChatId(array $data): ?int
    {
        return $data['message']['chat']['id'] ??
            $data['callback_query']['message']['chat']['id'] ??
            $data['inline_query']['chat']['id'] ??
            null;
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
        try {
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
        } catch (\Exception $e) {
            Log::error('Failed to store chat: ' . $e->getMessage(), [
                'chat_id' => $this->chatId,
                'user_id' => $this->userId,
                'data' => [
                    'first_name' => $this->userFirstName,
                    'last_name' => $this->userLastName,
                    'username' => $this->username,
                    'chat_type' => $this->chatType,
                    'last_message' => $this->messageText
                ]
            ]);
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
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            ["Привет, {$this->userFirstName}! Я бот компании. Выбери опцию на клавиатуре ниже."],
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleDefaultCommand()
    {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            "Не знаю такой команды, {$this->userFirstName}. Попробуй /start или выбери опцию на клавиатуре.",
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleMessage($message)
    {
        if ($this->media) {
            $response = "Получил медиа, {$this->userFirstName}! Пока не знаю, что с этим делать.";
            (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
                $response,
                $this->chatId,
                $this->keyboard
            );
            return;
        }

        switch ($message) {
            case 'О компании 📄':
                $this->handleAboutCompany();
                break;
            case 'Контакты 📩':
                $this->handleContacts();
                break;
            case 'Услуги и цены 💰':
                $this->handleServicesAndPrices();
                break;
            case 'Оставить заявку 📝':
                $this->handleRequest();
                break;
            default:
                $this->handleUnknownMessage();
        }
    }

    private function handleAboutCompany()
    {
        $response = "Мы крутая компания, {$this->userFirstName}! Работаем с 2000 года, делаем всё для клиентов.";
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleContacts()
    {
        $response = "Связаться с нами: телефон +7 (999) 123-45-67, email info@company.com.";
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleServicesAndPrices()
    {
        $response = "Услуги: разработка, дизайн, маркетинг. Вот наш прайс-лист!";
        $filePath = storage_path('app/public/pricelist.pdf');

        if (file_exists($filePath)) {
            (new \App\Services\Telegram\TelegramMessageService())->sendPhoto(
                $response,
                $filePath,
                null,
                $this->chatId,
                $this->keyboard
            );
        } else {
            (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
                "$response\nК сожалению, прайс-лист временно недоступен.",
                $this->chatId,
                $this->keyboard
            );
        }
    }

    private function handleRequest()
    {
        // Логика для обработки заявки, например, сохранение в БД
        $response = "Опиши, что нужно, {$this->userFirstName}, и мы свяжемся! (Пока просто напиши, я не умею обрабатывать заявки.)";
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleUnknownMessage()
    {
        $response = "Я не понимаю, о чём ты, {$this->userFirstName}. Используй кнопки на клавиатуре!";
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            $response,
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleCallback($callbackData)
    {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            "Получен callback, {$this->userFirstName}: $callbackData",
            $this->chatId,
            $this->keyboard
        );
    }

    private function handleInlineQuery($query)
    {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessageToChat(
            "Инлайн-запрос от {$this->userFirstName}: $query",
            $this->chatId,
            $this->keyboard
        );
    }
}
