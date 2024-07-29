<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class DMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'dms';
    }
}
