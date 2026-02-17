<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class StyleBuilder extends Builder
{
    public function available(): self
    {
        return $this->whereHas('items', fn(Builder $q) => $q->available());
    }

    public function consumed(): self
    {
        return $this->whereHas('items', fn(Builder $q) => $q->consumed());
    }

    public function withQuantityAvailable(): self
    {
        return $this->withCount([
            'items as quantity_available' => fn(Builder $q) => $q->available(),
        ]);
    }

    public function withQuantityConsumed(): self
    {
        return $this->withCount([
            'items as quantity_consumed' => fn(Builder $q) => $q->consumed(),
        ]);
    }

    public function withQuantityBeers(): self
    {
        return $this->withCount('beers as quantity_beers');
    }

    public function search(string $search): self
    {
        $search = strtolower($search);

        return $this->whereLike('name', "%{$search}%");
    }
}