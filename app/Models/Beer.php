<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    $with = ['style', 'brewery'];

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
