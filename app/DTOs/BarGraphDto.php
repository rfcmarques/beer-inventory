<?php

namespace App\DTOs;

use Illuminate\Support\Collection;

final readonly class BarGraphDto
{
    public function __construct(
        public string $label,
        public Collection $items,
        public string $valueField,
        public string $bgColor,
        public string $borderColor,
    ) {}

    public function labels(string $labelField): array
    {
        return $this->items->pluck($labelField)->toArray();
    }

    public function data(): array
    {
        return $this->items->pluck($this->valueField)->toArray();
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'collection' => $this->items,
            'valueField' => $this->valueField,
            'bgColor' => $this->bgColor,
            'borderColor' => $this->borderColor,
        ];
    }
}
