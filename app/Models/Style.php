<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\StyleOberserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([StyleOberserver::class])]
class Style extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function beers(): HasMany
    {
        return $this->hasMany(Beer::class);
    }

    /**
     * Scope a query to include 
     * styles with available items.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithAvailableItems(Builder $query): Builder
    {
        return $query->whereHas('beers.items', fn ($query) => $query->available());
    }

    /**
     * Scope a query to include 
     * styles with consumed items.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithConsumedItems(Builder $query)
    {
        return $query->whereHas('beers.items', fn ($query) => $query->consumed());
    }

    /**
     * Scope a query to include 
     * the count of available beers 
     * for each style.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithAvailableBeersCount(Builder $query): Builder
    {
        return $query->withCount([
            'beers as available_beers' => fn ($query) => $query->available()
        ]);
    }

    /**
     * Scope a query to include 
     * the count of consumed beers 
     * for each style.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithConsumedBeersCount(Builder $query): Builder
    {
        return $query->withCount([
            'beers as consumed_beers' => fn ($query) => $query->consumed()
        ]);
    }

    /**
     * Scope a query to include 
     * the count of available items 
     * for each style.
     *
     * @param Builder $query
     * @return Collection
     */
    public function scopeWithAvailableItemsCount(Builder $query): Collection
    {
        return $query->with(['beers' => fn ($query) => $query->quantityAvailable()])
            ->get()->each(function ($style) {
                $style->available_items = $style->beers->sum('quantity_available');
            });
    }

    /**
     * Scope a query to include 
     * the count of consumed items 
     * for each style.
     *
     * @param Builder $query
     * @return Collection
     */
    public function scopeWithConsumedItemsCount(Builder $query): Collection
    {
        return $query->with(['beers' => fn ($query) => $query->quantityConsumed()])
            ->get()->each(function ($style) {
                $style->consumed_items = $style->beers->sum('quantity_consumed');
            });
    }
}
