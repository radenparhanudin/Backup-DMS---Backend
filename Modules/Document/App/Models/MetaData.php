<?php

namespace Modules\Document\App\Models;

use App\Models\BaseModelUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetaData extends BaseModelUuid
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('sort_number');
        });
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
