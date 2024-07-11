<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\ItemObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([ItemObserver::class])]
class Item extends Model
{
    use HasFactory;

    protected $with = [
        'beer',
        'container'
    ];

    protected $fillable = [
        'beer_id',
        'expiration_date',
        'container_id',
        'consumed_at'
    ];

    protected $casts = [
        'consumed_at' => 'datetime:Y-m-d',
        'expiration_date' => 'datetime:Y-m-d'
    ];

    public function beer(): BelongsTo
    {
        return $this->belongsTo(Beer::class);
    }

    public function container(): BelongsTo
    {
        return $this->belongsTo(Container::class);
    }

    /**
     * Scope a query to only 
     * include available items.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAvailable($query): Builder
    {
        return $query->whereNull('consumed_at');
    }

    /**
     * Scope a query to only 
     * include consumed items.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeConsumed($query): Builder
    {
        return $query->whereNotNull('consumed_at');
    }

    /**
     * Scope a query to only 
     * include items that 
     * are expiring soon (within the next month).
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeExpiringSoon($query): Builder
    {
        return $query->available()
            ->where('expiration_date', '<', now()->addMonth());
    }

    /**
     * Scope a query to include 
     * the count of available items 
     * grouped by beer, container, and expiration date.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeQuantityAvailable($query)
    {
        return $query->available()
            ->select('beer_id', 'container_id', 'expiration_date')
            ->selectRaw('COUNT(*) as quantity_available')
            ->groupBy('beer_id', 'expiration_date', 'container_id');
    }

     /**
     * Scope a query to include 
     * the count of consumed items 
     * grouped by beer, container, 
     * expiration date, and consumed date.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeQuantityConsumed($query)
    {
        return $query->consumed()
            ->select('beer_id', 'container_id', 'expiration_date', 'consumed_at')
            ->selectRaw('COUNT(*) as quantity_consumed')
            ->groupBy('beer_id', 'expiration_date', 'container_id');
    }
}
