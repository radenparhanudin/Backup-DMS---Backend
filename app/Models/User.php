<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\DataReference\App\Models\UnitOrganisasi;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'password',
        'dms_token',
        'unit_organisasi_id',
        'avatar',
        'tanggal_update',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public $guard_name = 'api';

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

    public function unit_organisasi(): BelongsTo
    {
        return $this->belongsTo(UnitOrganisasi::class);
    }
}
