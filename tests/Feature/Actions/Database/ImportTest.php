<?php

declare(strict_types=1);

use App\Actions\Database\Backup;
use App\Actions\Database\Import;
use App\Exceptions\BackupFileNotFoundException;
use App\Exceptions\InvalidBackupFormatException;
use App\Models\Country;
use App\Models\Style;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('backups');
});

it('should import a full backup (round-trip)', function () {
    User::factory()->create();
    Country::factory()->count(2)->create();
    Style::factory()->count(3)->create();

    $expectedCounts = [
        'users' => User::count(),
        'countries' => Country::count(),
        'styles' => Style::count(),
    ];

    $filename = app(Backup::class)->handle();

    Style::query()->delete();
    Country::query()->delete();
    User::query()->delete();

    app(Import::class)->handle($filename);

    expect(User::count())->toBe($expectedCounts['users'])
        ->and(Country::count())->toBe($expectedCounts['countries'])
        ->and(Style::count())->toBe($expectedCounts['styles']);
});

it('should import only a specific table', function () {
    Style::factory()->count(3)->create();
    User::factory()->create();

    $filename = app(Backup::class)->handle();

    Style::query()->delete();
    User::query()->delete();

    app(Import::class)->handle($filename, 'styles');

    expect(Style::count())->toBe(3)
        ->and(User::count())->toBe(0);
});

it('should throw an exception when file does not exist', function () {
    app(Import::class)->handle('non_existent.json');
})->throws(BackupFileNotFoundException::class);

it('should throw an exception for invalid json', function () {
    Storage::disk('backups')->put('invalid.json', '{not-valid-json');

    app(Import::class)->handle('invalid.json');
})->throws(InvalidBackupFormatException::class);

it('should truncate existing data before importing', function () {
    Style::factory()->count(5)->create();

    $twoStyles = Style::factory()->count(2)->create();
    $backupData = [
        'styles' => $twoStyles->map(fn ($s) => $s->toArray())->all(),
    ];

    Storage::disk('backups')->put('truncate_test.json', json_encode($backupData));

    app(Import::class)->handle('truncate_test.json', 'styles');

    expect(Style::count())->toBe(2);
});
