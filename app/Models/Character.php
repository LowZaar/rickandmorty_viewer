<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Character extends Model
{
    protected $fillable = [
        'api_id',
        'name',
        'status',
        'species',
        'type',
        'gender',
        'origin',
        'image',
    ];


    public function origin(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'origin_id');
    }

    public function current_location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    
    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }
}
