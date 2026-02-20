<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class ItemBuilder extends Builder
{
    public function available(): self
    {
        return $this->whereNull('consumed_at');
    }

    public function consumed(): self
    {
        return $this->whereNotNull('consumed_at');
    }

    public function search(string $search): self
    {
        $search = strtolower($search);

        return $this->when($search, function (Builder $q) use ($search) {
            $q->where(function (Builder $query) use ($search) {
                $query->whereHas('beer', function (Builder $q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('beer', function (Builder $q) use ($search) {
                        $q->whereHas('brewery', function (Builder $q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                    })
                    ->orWhereHas('beer', function (Builder $q) use ($search) {
                        $q->whereHas('style', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                    });
            });
        });
    }

    public function expiringSoon(): self
    {
        return $this->available()
            ->where('expiration_date', '>=', now()->subWeeks(2))
            ->orderBy('expiration_date', 'asc');
    }

    public function lastConsumed(): self
    {
        return $this->consumed()
            ->orderBy('consumed_at', 'desc');
    }

    public function consumedAt(string $date): self
    {
        return $this->where('consumed_at', $date);
    }

    public function consumedBetween(string $startDate, string $endDate): self
    {
        return $this->whereBetween('consumed_at', [$startDate, $endDate]);
    }

    public function consumedLastWeek(): self
    {
        return $this->consumedBetween(
            now()->startOfWeek()->toDateString(),
            now()->toDateString()
        );
    }

    public function consumedLastMonth(): self
    {
        return $this->consumedBetween(
            now()->startOfMonth()->toDateString(),
            now()->toDateString()
        );
    }

    public function consumedThisYear(): self
    {
        return $this->consumedBetween(
            now()->startOfYear()->toDateString(),
            now()->toDateString()
        );
    }

    public function consumedLastYear(): self
    {
        return $this->consumedBetween(
            now()->startOfYear()->subYear()->toDateString(),
            now()->startOfYear()->toDateString()
        );
    }

    public function expiringAt(string $date): self
    {
        return $this->where('expiration_date', $date);
    }

    public function expiringBetween(string $startDate, string $endDate): self
    {
        return $this->whereBetween('expiration_date', [$startDate, $endDate]);
    }

    public function expiringUntilNextWeek(): self
    {
        return $this->expiringBetween(
            now()->toDateString(),
            now()->addWeek()->endOfWeek()->toDateString()
        );
    }

    public function expiringUntilNextMonth(): self
    {
        return $this->expiringBetween(
            now()->toDateString(),
            now()->addMonth()->endOfMonth()->toDateString()
        );
    }

    public function expiringUntilNextYear(): self
    {
        return $this->expiringBetween(
            now()->toDateString(),
            now()->addYear()->endOfYear()->toDateString()
        );
    }
}