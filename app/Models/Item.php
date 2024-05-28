<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\ItemObserver;

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

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public static function available()
    {
        return Item::where('consumed_at', null)->get();
    }
}
