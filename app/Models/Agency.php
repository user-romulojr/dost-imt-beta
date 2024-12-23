<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Model
{
    protected $table = 'agencies';

    protected $fillable = [
        'name',
        'acronym',
        'agency_group',
        'contact',
        'website',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function indicators(): BelongsToMany
    {
        return $this->belongsToMany(Indicator::class);
    }
}
