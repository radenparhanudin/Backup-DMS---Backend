<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class BaseModelUuid extends Model
{
    use Uuid;

    protected $keyType = 'string';

    public $incrementing = false;

    protected function serializeDate($date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $searchs)
    {
        return $query->where(function ($query) use ($searchs) {
            foreach ($searchs as $key => $value) {
                if (isset($value)) {
                    $query = $query->where($key, 'like', "%$value%");
                }
            }
        });

        return $query;
    }
}
