<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\BeerObserver;

#[ObservedBy(BeerObserver::class)]
class Beer extends Model
{
    use HasFactory;

    protected $with = ['style', 'brewery'];

    protected $fillable = ['brewery_id', 'style_id', 'name', 'abv'];

    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    public function brewery()
    {
        return $this->belongsTo(Brewery::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
