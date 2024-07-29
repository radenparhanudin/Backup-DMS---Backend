<?php

namespace Modules\DataReference\App\Models;

use App\Models\BaseModelUuid;

class DocumentType extends BaseModelUuid
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('name');
        });
    }
}
