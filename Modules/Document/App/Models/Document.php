<?php

namespace Modules\Document\App\Models;

use App\Models\BaseModelUuid;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\DataReference\App\Models\DocumentStatus;
use Modules\DataReference\App\Models\DocumentType;

class Document extends BaseModelUuid
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('tanggal_update', 'desc');
        });
    }

    public function document_type(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function document_status(): BelongsTo
    {
        return $this->belongsTo(DocumentStatus::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function meta_data(): HasMany
    {
        return $this->hasMany(MetaData::class);
    }
}
