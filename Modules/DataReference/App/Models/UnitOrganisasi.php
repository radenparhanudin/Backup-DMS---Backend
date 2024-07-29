<?php

namespace Modules\DataReference\App\Models;

use App\Models\BaseModelUuid;

class UnitOrganisasi extends BaseModelUuid
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('nama_unor');
        });
    }
}
