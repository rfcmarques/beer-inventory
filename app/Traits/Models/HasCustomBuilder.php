<?php

declare(strict_types=1);

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

trait HasCustomBuilder
{
    public function newEloquentBuilder($query): Builder
    {
        if (method_exists($this, 'provideCustomBuilder')) {
            $builderClass = $this->provideCustomBuilder();

            if (class_exists($builderClass) && is_subclass_of($builderClass, Builder::class)) {
                return new $builderClass($query);
            }
        }

        $className = static::class;
        $builderClass = str_replace('App\\', 'App\\Builders\\', $className) . 'Builder';

        if (str_starts_with($className, 'App\\Models\\')) {
            $builderClass = str_replace('App\\Models\\', 'App\\Builders\\', $className) . 'Builder';
        }

        if (class_exists($builderClass) && is_subclass_of($builderClass, Builder::class)) {
            return new $builderClass($query);
        }

        return new Builder($query);
    }
}
