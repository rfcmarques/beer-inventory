<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\ContainerObserver;

#[ObservedBy([ContainerObserver::class])]
class Container extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
