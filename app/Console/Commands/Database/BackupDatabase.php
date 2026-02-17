<?php

declare(strict_types=1);

namespace App\Console\Commands\Database;

use App\Actions\Database\Backup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup
                            {--filename= : Define a custom name for the file}
                            {--table= : Backup only a specific table}';

    protected $description = 'Export data from the database to a JSON file';

    public function handle(Backup $action): int
    {
        $this->components->info('Backup started...');

        try {
            $specificTable = $this->option('table');
            $customFilename = $this->option('filename');

            $storedFilename = $action->handle(
                specificTable: is_string($specificTable) ? $specificTable : null,
                customFilename: is_string($customFilename) ? $customFilename : null
            );

            $this->components->success('Backup criado com sucesso!');

            $disk = Storage::disk('backups');
            $path = $disk->path($storedFilename);

            $this->table(
                ['File', 'Size', 'Location'],
                [
                    [
                        $storedFilename,
                        $this->formatBytes($disk->size($storedFilename)),
                        $path
                    ]
                ]
            );

            return self::SUCCESS;
        } catch (\Throwable $th) {
            $this->components->error("Error during backup: {$th->getMessage()}");
            return self::FAILURE;
        }
    }

    protected function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
