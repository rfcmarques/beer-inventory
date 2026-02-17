<?php

declare(strict_types=1);

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:builder', description: 'Create a new Eloquent Builder class')]
class MakeBuilder extends GeneratorCommand
{
    protected $name = 'make:builder';
    protected $description = 'Create a new Eloquent Builder class';
    protected $type = 'Builder';

    protected function getStub(): string
    {
        return base_path('stubs/builder.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\\Builders';
    }

    protected function getNameInput(): string
    {
        $name = trim($this->argument('name'));

        if (!str_ends_with($name, 'Builder')) {
            $name .= 'Builder';
        }

        return $name;
    }
}
