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

    public function sendPhoto($message, $filePath, ?string $thread = null)
    {
        $url = 'sendPhoto?chat_id=' . $this->chatId . '&parse_mode=HTML';
        if ($thread && $this->getThread($thread)) {
            $url .= '&message_thread_id=' . $this->getThread($thread);
        }

        $this->client->post($url, [
            'multipart' => [
                [
                    'name' => 'photo',
                    'contents' => fopen($filePath, 'r'),
                    'filename' => basename($filePath)
                ],
                [
                    'name' => 'caption',
                    'contents' => $this->prepareMessage($message)
                ]
            ]
        ]);
    }

    public function sendMessageToChat($message, $chatId)
    {
        $this->client->get('sendMessage?chat_id=' . $chatId . '&parse_mode=HTML', [
            'json' => ['text' => $this->prepareMessage($message)]
        ]);
    }

    public function getThread($thread)
    {
        if (isset($this->threads[$thread])) {
            return $this->threads[$thread];
        }
        return null;
    }

    protected function prepareMessage($message)
    {
        if (is_array($message)) {
            $message = implode("\n", $message);
        }

        return $message;
    }
}
