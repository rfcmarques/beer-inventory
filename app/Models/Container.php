<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\ContainerObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([ContainerObserver::class])]
class Container extends Model
{
    use HasFactory;

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Scope a query to include the 
     * count of available items in each container.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithAvailableItemsCount(Builder $query): Collection
    {
        return $query->with(['items' => fn ($query) => $query->quantityAvailable()])
            ->get()->each(function ($container) {
                $container->available_items = $container->items->sum('quantity_available');
            });
    }

    /**
     * Scope a query to include the 
     * count of consumed items in each container.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithConsumedItemsCount(Builder $query): Collection
    {
        return $query->with(['items' => fn ($query) => $query->quantityConsumed()])
            ->get()->each(function ($container) {
                $container->consumed_items = $container->items->sum('quantity_consumed');
            });
    }
}
