<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $with = ['beer', 'container'];

    protected $fillable = ['beer_id', 'expiration_date', 'container_id'];

    protected $casts = [
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
}
