<?php

declare(strict_types=1);

namespace App\Actions\Database;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

final readonly class Backup
{
    protected const TABLES = [
        'users',
        'beers',
        'styles',
        'breweries',
        'items',
        'containers',
        'countries',
    ];

    public function handle(?string $specificTable = null, ?string $customFilename = null): string
    {
        $tablesToBackup = $this->resolveTables($specificTable);

        $data = [];
        foreach ($tablesToBackup as $table) {
            $data[$table] = DB::table($table)->get()->toArray();
        }

        $jsonContent = json_encode($data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);

        $filename = $this->generateFilename($specificTable, $customFilename);

        Storage::disk('backups')->put($filename, $jsonContent);

        return $filename;
    }

    protected function resolveTables(?string $specificTable): array
    {
        if ($specificTable) {
            if (!Schema::hasTable($specificTable)) {
                throw new InvalidArgumentException("The table '{$specificTable}' does not exist in the database.");
            }
            return [$specificTable];
        }

        return self::TABLES;
    }

    protected function generateFilename(?string $specificTable, ?string $customFilename): string
    {
        if ($customFilename) {
            return str_ends_with($customFilename, '.json')
                ? $customFilename
                : "{$customFilename}.json";
        }

        $timestamp = now()->format('Y_m_d_H_i_s');
        $prefix = $specificTable ?? 'backup';

        return "{$prefix}_{$timestamp}.json";
    }
}