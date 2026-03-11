<?php

declare(strict_types=1);

use App\Actions\Database\Backup;
use App\Models\Beer;
use App\Models\Style;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('backups');
});

it('should backup all default tables', function () {
    User::factory()->create();
    Style::factory()->create();
    Beer::factory()->create();

    $filename = app(Backup::class)->handle();

    Storage::disk('backups')->assertExists($filename);

    $data = json_decode(Storage::disk('backups')->get($filename), true);

    expect($data)
        ->toHaveKeys(['users', 'beers', 'styles', 'breweries', 'items', 'containers', 'countries'])
        ->and(count($data['users']))->toBe(User::count())
        ->and(count($data['styles']))->toBe(Style::count())
        ->and(count($data['beers']))->toBe(Beer::count());
});

it('should backup only a specific table', function () {
    Style::factory()->count(3)->create();

    $filename = app(Backup::class)->handle('styles');

    $data = json_decode(Storage::disk('backups')->get($filename), true);

    expect($data)
        ->toHaveKey('styles')
        ->not->toHaveKey('users')
        ->not->toHaveKey('beers')
        ->and(count($data['styles']))->toBe(3);
});

it('should throw an exception for non-existent table', function () {
    app(Backup::class)->handle('tabela_fake');
})->throws(InvalidArgumentException::class);

it('should generate filename with timestamp by default', function () {
    $filename = app(Backup::class)->handle();

    expect($filename)->toMatch('/^backup_\d{4}_\d{2}_\d{2}_\d{2}_\d{2}_\d{2}\.json$/');
});

it('should use custom filename correctly', function () {
    $withoutExtension = app(Backup::class)->handle(customFilename: 'meu_backup');
    $withExtension = app(Backup::class)->handle(customFilename: 'outro.json');

    expect($withoutExtension)->toBe('meu_backup.json')
        ->and($withExtension)->toBe('outro.json');

    Storage::disk('backups')->assertExists('meu_backup.json');
    Storage::disk('backups')->assertExists('outro.json');
});
