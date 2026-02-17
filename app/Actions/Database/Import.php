<?php

declare(strict_types=1);

namespace App\Actions\Database;

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Container;
use App\Models\Country;
use App\Models\Item;
use App\Models\Style;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

final readonly class Import
{
    protected const TABLE_MAPPER = [
        'users' => User::class,
        'beers' => Beer::class,
        'styles' => Style::class,
        'breweries' => Brewery::class,
        'items' => Item::class,
        'containers' => Container::class,
        'countries' => Country::class,
    ];

    protected const CHUNK_SIZE = 500;

    public function handle(string $filePath, ?string $table = null): void
    {
        $data = $this->loadBackupData($filePath);
        $tablesToProcess = $this->resolveTables($table);

        $this->executeImport($data, $tablesToProcess);
    }

    protected function loadBackupData(string $filePath): array
    {
        $this->ensureFileExists($filePath);

        $jsonContent = Storage::disk('backups')->get($filePath);
        $data = json_decode($jsonContent, true);

        if (!is_array($data)) {
            throw new Exception('Invalid JSON format');
        }

        return $data;
    }

    protected function ensureFileExists(string $filePath): void
    {
        if (!Storage::disk('backups')->exists($filePath)) {
            throw new Exception('File not found');
        }
    }

    protected function resolveTables(?string $table): array
    {
        if ($table === null) {
            return self::TABLE_MAPPER;
        }

        return [$table => self::TABLE_MAPPER[$table]];
    }

    protected function executeImport(array $data, array $tablesToProcess): void
    {
        try {
            Schema::disableForeignKeyConstraints();

            DB::transaction(function () use ($data, $tablesToProcess): void {
                foreach ($tablesToProcess as $table => $model) {
                    $this->importTable($table, $model, $data);
                }
            });
        } finally {
            Schema::enableForeignKeyConstraints();
        }
    }

    protected function importTable(string $table, string $model, array $data): void
    {
        if (!isset($data[$table])) {
            return;
        }

        $records = $data[$table];

        $model::truncate();

        $this->insertInChunks($model, $records);
    }

    protected function insertInChunks(string $model, array $records): void
    {
        foreach (array_chunk($records, self::CHUNK_SIZE) as $chunk) {
            $model::insert($chunk);
        }
    }
}