<?php

namespace App\Services\Telegram;

use GuzzleHttp\Client;

class TelegramService
{
    protected $token;
    protected $chatId;
    protected $client;

    public function __construct()
    {
        $this->token = config('services.telegram.token');
        $this->chatId = config('services.telegram.chat_id');

        $this->client = new Client([
            'base_uri' => "https://api.telegram.org/bot" . $this->token . "/"
        ]);
    }
}
