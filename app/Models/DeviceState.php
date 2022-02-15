<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;


class DeviceState extends Model
{
    protected $fillable = [
        'state'
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
