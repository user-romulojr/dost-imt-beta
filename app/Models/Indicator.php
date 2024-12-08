<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Indicator extends Model
{
    protected $fillable = [
        'title',
        'end_year',
        'operational_definition',
        'type',
        'request_approve',
        'status',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function majorFinalOutputs(): HasMany
    {
        return $this->hasMany(Mfo::class);
    }

    public function agencies(): BelongsToMany
    {
        return $this->belongsToMany(Agency::class)->withPivot('request_approve', 'verdict');
    }
}
