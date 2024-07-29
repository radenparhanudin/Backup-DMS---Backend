<?php

namespace Modules\DataReference\App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Document\App\Models\Document;

class DocumentStatus extends BaseModel
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('id');
        });
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
