<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class YaMetrika extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ya-metrika';
    }
}
