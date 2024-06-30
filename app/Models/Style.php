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

    public function scopeWithAvailableItems(Builder $query): Builder
    {
        return $query->whereHas('beers.items', fn ($query) => $query->available());
    }

    public function scopeWithConsumedItems(Builder $query)
    {
        return $query->whereHas('beers.items', fn ($query) => $query->consumed());
    }

    public function scopeWithAvailableBeersCount(Builder $query): Builder
    {
        return $query->withCount([
            'beers as available_beers' => fn ($query) => $query->available()
        ]);
    }

    public function scopeWithConsumedBeersCount(Builder $query): Builder
    {
        return $query->withCount([
            'beers as consumed_beers' => fn ($query) => $query->consumed()
        ]);
    }

    public function scopeWithAvailableItemsCount(Builder $query): Collection
    {
        return $query->with(['beers' => fn ($query) => $query->quantityAvailable()])
            ->get()->each(function ($style) {
                $style->available_items = $style->beers->sum('quantity_available');
            });
    }

    public function scopeWithConsumedItemsCount(Builder $query): Collection
    {
        return $query->with(['beers' => fn ($query) => $query->quantityConsumed()])
            ->get()->each(function ($style) {
                $style->consumed_items = $style->beers->sum('quantity_consumed');
            });
    }
}
