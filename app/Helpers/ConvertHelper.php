<?php

namespace App\Helpers;

class ConvertHelper
{
    public function arrayToObject(array $data)
    {
        return json_decode(json_encode($data));
    }
}
