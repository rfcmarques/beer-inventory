<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\BeerObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(BeerObserver::class)]
class Beer extends Model
{
    use HasFactory;

    protected $with = ['style', 'brewery'];

    protected $fillable = ['brewery_id', 'style_id', 'name', 'abv'];

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }

    public function brewery(): BelongsTo
    {
        return $this->belongsTo(Brewery::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Scope a query to only include 
     * beers with available items.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->whereHas('items', fn ($query) => $query->available());
    }

    /**
     * Scope a query to only include 
     * beers with consumed items.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeConsumed(Builder $query): Builder
    {
        return $query->whereHas('items', fn ($query) => $query->consumed());
    }

    /**
     * Scope a query to include 
     * the count of available items 
     * for each beer.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeQuantityAvailable(Builder $query): Builder
    {
        return $query->withCount([
            'items as quantity_available' => fn ($query) => $query->available()
        ]);
    }

    /**
     * Scope a query to include t
     * he count of consumed items 
     * for each beer.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeQuantityConsumed(Builder $query): Builder
    {
        return $query->withCount([
            'items as quantity_consumed' => fn ($query) => $query->consumed()
        ]);
    }
}
