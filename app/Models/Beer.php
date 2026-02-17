<?php

namespace App\Models;

use App\Traits\Models\HasCustomBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Beer extends Model
{
    /** @use HasFactory<\Database\Factories\BeerFactory> */
    use HasFactory;
    use HasCustomBuilder;

    protected $fillable = [
        'name',
        'brewery_id',
        'style_id',
        'abv',
    ];

    protected $casts = [
        'abv' => 'decimal:2'
    ];

    public function brewery(): BelongsTo
    {
        return $this->belongsTo(Brewery::class);
    }

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class); 
    }
}
