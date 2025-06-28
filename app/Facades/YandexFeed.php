<?php

namespace App\Facades;

use App\Services\Yandex\YandexFeedService;
use Illuminate\Support\Facades\Facade;

class YandexFeed extends Facade
{
    protected static function getFacadeAccessor()
    {
        return YandexFeedService::class;
    }
}
