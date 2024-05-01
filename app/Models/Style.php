<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\StyleOberserver;

#[ObservedBy([StyleOberserver::class])]
class Style extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function beers()
    {
        return $this->hasMany(Beer::class);
    }
}
