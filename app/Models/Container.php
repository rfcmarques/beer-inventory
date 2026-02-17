<?php

namespace App\Models;

use App\Enums\ContainerType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    /** @use HasFactory<\Database\Factories\ContainerFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'capacity',
    ];

    protected function label(): Attribute
    {
        return new Attribute(
            get: fn() => ContainerType::from(strtolower($this->type))->label($this->capacity)
        );
    }
}
