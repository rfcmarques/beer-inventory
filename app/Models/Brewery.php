<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\BreweryObserver;

#[ObservedBy([BreweryObserver::class])]
class Brewery extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country', 'logo'];

    public function beers()
    {
        return $this->hasMany(Beer::class);
    }
}
