<?php

namespace App\Services\Telegram;

class TelegramMessageService extends TelegramService
{
    public $threads = [
        'event' => 1138,
        'analytics' => 1051,
        'error' => 1136,
        'order' => 1053,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function sendMessage($message, ?string $thread = null)
    {
        $url = 'sendMessage?chat_id=' . $this->chatId . '&parse_mode=HTML';
        if ($thread && $this->getThread($thread)) {
            $url .= '&message_thread_id=' . $this->getThread($thread);
        }

        $this->client->post($url, [
            'json' => [
                'text' => $this->prepareMessage($message)
            ]
        ]);
    }

    public function sendDocument($message, $filePath, ?string $thread = null, $chatId = null, $keyboard = null)
    {
        $url = 'sendDocument?chat_id=' . ($chatId ?? $this->chatId) . '&parse_mode=HTML';
        if ($thread && $this->getThread($thread)) {
            $url .= '&message_thread_id=' . $this->getThread($thread);
        }

        $payload = [
            [
                'name' => 'document',
                'contents' => fopen($filePath, 'r'),
                'filename' => basename($filePath)
            ],
            [
                'name' => 'caption',
                'contents' => $this->prepareMessage($message)
            ]
        ];

        if ($keyboard) {
            $payload[] = [
                'name' => 'reply_markup',
                'contents' => json_encode($keyboard)
            ];
        }

        $this->client->post($url, [
            'multipart' => $payload
        ]);
    }

    public function sendMessageToChat($message, $chatId, $keyboard = null)
    {
        $payload = [
            'chat_id' => $chatId,
            'text' => $this->prepareMessage($message),
            'parse_mode' => 'HTML'
        ];

        if ($keyboard) {
            $payload['reply_markup'] = $keyboard;
        }

        $this->client->post('sendMessage', [
            'json' => $payload
        ]);
    }

    public function getThread($thread)
    {
        return $this->threads[$thread] ?? null;
    }

    protected function prepareMessage($message)
    {
        if (is_array($message)) {
            $message = implode("\n", $message);
        }

        return $message;
    }
}
