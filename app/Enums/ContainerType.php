<?php

namespace App\Enums;

enum ContainerType: string
{
    case BOTTLE = 'bottle';
    case CAN = 'can';

    public function label(int $capacity): string
    {
        return sprintf('%s %d ml', ucfirst($this->value), $capacity);
    }
}