<?php

namespace App\Services\Telegram;

class TelegramWebhookService extends TelegramService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setWebhook()
    {
        $this->client->get('setWebhook?url=' . env('TELEGRAM_WEBHOOK_URL'));
        return $this->client->get('getWebhookInfo');
    }
}
