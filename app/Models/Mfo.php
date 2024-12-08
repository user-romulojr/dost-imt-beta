<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mfo extends Model
{
    protected $fillable = [
        'title',
    ];

    public function successIndicators(): HasMany
    {
        return $this->hasMany(SuccessIndicator::class);
    }

    public function indicator(): BelongsTo
    {
        return $this->belongsTo(Indicator::class);
    }
}
