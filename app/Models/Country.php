<?php

namespace App\Models;

use App\Traits\Models\HasCustomBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    use HasCustomBuilder;

    protected $fillable = [
        'code',
        'name',
        'official_name',
        'capital',
        'flag_url',
    ];

    public function breweries(): HasMany
    {
        return $this->hasMany(Brewery::class);
    }
}
