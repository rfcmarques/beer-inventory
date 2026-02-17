<?php

declare(strict_types=1);

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:dto', description: 'Create a new immutable Data Transfer Object')]
class MakeDTO extends GeneratorCommand
{
    protected $signature = 'make:dto {name : The name of the DTO}';
    protected $description = 'Create a new immutable Data Transfer Object';
    protected $type = 'DTO';

    protected function getStub(): string
    {
        return base_path('stubs/dto.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\\DTOs';
    }

    protected function getNameInput(): string
    {
        $name = trim($this->argument('name'));

        if (!str_ends_with($name, 'DTO')) {
            $name .= 'DTO';
        }

        return $name;
    }
}
