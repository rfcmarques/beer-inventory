<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\ContainerObserver;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([ContainerObserver::class])]
class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function breweries(): HasMany
    {
        return $this->hasMany(Brewery::class);
    }
}
