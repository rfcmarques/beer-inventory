<?php

declare(strict_types=1);

namespace App\Contracts;

interface ModelWithCustomBuilder
{
    /**
     * Provide the custom Eloquent builder class name.
     * 
     * @return class-string<\Illuminate\Database\Eloquent\Builder>
     */
    public function provideCustomBuilder(): string;
}
