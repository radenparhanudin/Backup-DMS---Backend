<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use Uuid;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = ['id'];

    protected $hidden = [
        'pivot',
    ];

    protected function serializeDate($date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('level', 'asc');
        });
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
