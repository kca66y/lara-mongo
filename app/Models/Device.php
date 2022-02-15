<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsToMany;
use Jenssegers\Mongodb\Relations\HasMany;

/**
 * @property DeviceState state
 */
class Device extends Model
{
    protected $fillable = [
        'login',
        'passwd',
        'name'
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function state(): HasMany
    {
        return $this->hasMany(DeviceState::class);
    }
}
