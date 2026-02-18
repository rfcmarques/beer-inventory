<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Models\HasCustomBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Style extends Model
{
    use HasFactory;
    use HasCustomBuilder;

    protected $fillable = [
        'name',
        'srm',
    ];

    protected function casts(): array
    {
        return [
            'srm' => 'integer',
        ];
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
