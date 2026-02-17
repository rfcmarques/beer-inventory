<?php

namespace App\Models;

use App\Traits\Models\HasCustomBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Brewery extends Model
{
    /** @use HasFactory<\Database\Factories\BreweryFactory> */
    use HasFactory;
    use HasCustomBuilder;

    protected $fillable = [
        'name',
        'country_id',
        'logo',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function beers(): HasMany
    {
        return $this->hasMany(Beer::class);
    }

    public function items(): HasManyThrough
    {
        return $this->hasManyThrough(Item::class, Beer::class);
    }
}
