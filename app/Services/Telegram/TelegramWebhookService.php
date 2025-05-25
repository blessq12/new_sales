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
        $this->client->post('setWebhook', [
            'json' => ['url' => 'https://api.telegram.org/bot' . $this->token . '/setWebhook'],
        ]);

        return $this->client->get('getWebhookInfo');
    }
}
