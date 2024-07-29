<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ResponseJson extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'response-json';
    }
}
