<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\BreweryObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([BreweryObserver::class])]
class Brewery extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country', 'logo'];

    public function beers(): HasMany
    {
        return $this->hasMany(Beer::class);
    }

    /**
     * Scope a query to only include 
     * breweries with available items.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithAvailableItems(Builder $query): Builder
    {
        return $query->whereHas('beers.items', fn ($query) => $query->available());
    }

    /**
     * Scope a query to only include 
     * breweries with consumed items.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithConsumedItems(Builder $query): Builder
    {
        return $query->whereHas('beers.items', fn ($query) => $query->consumed());
    }

    /**
     * Scope a query to include 
     * the count of available beers 
     * for each brewery.
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
     * for each brewery.
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
     * for each brewery.
     *
     * @param Builder $query
     * @return Collection
     */
    public function scopeWithAvailableItemsCount(Builder $query): Collection
    {
        return $query->with(['beers' => function ($query) {
            $query->quantityAvailable();
        }])->get()->each(function ($brewery) {
            $brewery->available_items = $brewery->beers->sum('quantity_available');
        });
    }

    /**
     * Scope a query to include 
     * the count of consumed items 
     * for each brewery.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithConsumedItemsCount(Builder $query): Collection
    {
        return $query->with(['beers' => function ($query) {
            $query->quantityConsumed();
        }])->get()->each(function ($brewery) {
            $brewery->consumed_items = $brewery->beers->sum('quantity_consumed');
        });
    }

    /**
     * Scope a query to group 
     * breweries by country 
     * and include the count 
     * of breweries in each country.
     *
     * @param Builder $query
     * @return Collection
     */
    public function scopeByCountry(Builder $query): Collection
    {
        return $query->get()
            ->countBy('country')
            ->map(function ($amount, $country) {
                return [
                    'total_breweries' => $amount,
                    'breweries' => Brewery::where('country', $country)->get()
                ];
            });
    }

    /**
     * Scope a query to group 
     * breweries with available items 
     * by country and include the count 
     * of breweries in each country.
     *
     * @param Builder $query
     * @return Collection
     */
    public function scopeAvailableByCountry(Builder $query)
    {
        return $query->WithAvailableItems()
            ->get()
            ->countBy('country')
            ->map(function ($amount, $country) {
                return [
                    'total_breweries' => $amount,
                    'breweries' => Brewery::WithAvailableItems()
                        ->where('country', $country)
                        ->get()
                ];
            });
    }

    /**
     * Scope a query to group 
     * breweries with consumed items 
     * by country and include the count 
     * of breweries in each country.
     *
     * @param Builder $query
     * @return Collection
     */
    public function scopeConsumedByCountry(Builder $query)
    {
        return $query->WithConsumedItems()
            ->get()
            ->countBy('country')
            ->map(function ($amount, $country) {
                return [
                    'total_breweries' => $amount,
                    'breweries' => Brewery::WithConsumedItems()
                        ->where('country', $country)
                        ->get()
                ];
            });
    }

    /**
     * Scope a query 
     * to get the count 
     * of available items by country.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAvailableItemsByCountry($query)
    {
        return $query->select('breweries.country')
            ->selectRaw('COUNT(items.id) as available_items_count')
            ->join('beers', 'breweries.id', '=', 'beers.brewery_id')
            ->join('items', 'beers.id', '=', 'items.beer_id')
            ->whereNull('items.consumed_at')
            ->groupBy('breweries.country');
    }

    /**
     * Scope a query 
     * to get the count 
     * of consumed items by country.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeConsumedItemsByCountry($query)
    {
        return $query->select('breweries.country')
            ->selectRaw('COUNT(items.id) as available_items_count')
            ->join('beers', 'breweries.id', '=', 'beers.brewery_id')
            ->join('items', 'beers.id', '=', 'items.beer_id')
            ->whereNotNull('items.consumed_at')
            ->groupBy('breweries.country');
    }
}
