<?php

declare(strict_types=1);

namespace App\Enums;

enum ContainerType: string
{
    case CAN = 'can';
    case BOTTLE = 'bottle';

    public function toArray(): array
    {
        return [
            self::CAN->value => 'Can',
            self::BOTTLE->value => 'Bottle',
        ];
    }

    public function label(int $capacity): string
    {
        return sprintf('%s %dml', ucfirst($this->value), $capacity);
    }
}
