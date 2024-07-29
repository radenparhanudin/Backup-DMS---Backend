<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
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
