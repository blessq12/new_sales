<?php

namespace App\Services\Yandex;

use GuzzleHttp\Client;

class YandexService
{
    protected $token;
    protected $client;

    public function __construct()
    {
        $this->token = config('services.yandex.token');
        $this->client = new Client(['headers' => ['Authorization' => 'Bearer ' . $this->token]]);
    }
}
