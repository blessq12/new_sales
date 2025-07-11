<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\SiteMapService;

class SiteMap extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SiteMapService::class;
    }
}
