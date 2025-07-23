<?php

namespace App\Services\Telegram;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $token;
    protected $chatId;
    protected $client;

    public function __construct()
    {
        $this->token = config('services.telegram.token');
        $this->chatId = config('services.telegram.chat_id');

        if (!$this->token) {
            Log::error('Telegram bot token not configured');
            throw new \Exception('Telegram bot token not configured');
        }

        $this->client = new Client([
            'base_uri' => "https://api.telegram.org/bot" . $this->token . "/",
            'timeout' => 10,
            'connect_timeout' => 5
        ]);
    }

    protected function makeRequest($method, $url, $options = [])
    {
        try {
            $response = $this->client->request($method, $url, $options);
            $body = json_decode($response->getBody(), true);

            if (!$body['ok']) {
                Log::error("Telegram API error", [
                    'error_code' => $body['error_code'] ?? null,
                    'description' => $body['description'] ?? null
                ]);
                return false;
            }

            return $body;
        } catch (\Exception $e) {
            Log::error("Telegram API request failed: " . $e->getMessage(), [
                'method' => $method,
                'url' => $url,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}
