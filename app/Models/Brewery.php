<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brewery extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country'];

    public function beers()
    {
        return $this->hasMany(Beer::class);
    }
}
