<?php

namespace App\Models;

use App\Traits\Models\HasCustomBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;
    use HasCustomBuilder;

    protected $fillable = [
        'beer_id',
        'container_id',
        'consumed_at',
        'expiration_date',
    ];

    protected $casts = [
        'consumed_at' => 'datetime:Y-m-d',
        'expiration_date' => 'datetime:Y-m-d',
    ];

    public function beer(): BelongsTo
    {
        return $this->belongsTo(Beer::class);
    }

    public function container(): BelongsTo
    {
        return $this->belongsTo(Container::class);
    }
}
