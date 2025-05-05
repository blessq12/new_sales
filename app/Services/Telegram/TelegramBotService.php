<?php

namespace App\Services\Telegram;

class TelegramBotService extends TelegramService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMe()
    {
        return $this->client->get('getMe')->getBody()->getContents();
    }

    public function getUpdates()
    {
        return $this->client->get('getUpdates')->getBody()->getContents();
    }
}
