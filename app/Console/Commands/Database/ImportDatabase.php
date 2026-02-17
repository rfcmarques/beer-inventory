<?php

declare(strict_types=1);

namespace App\Console\Commands\Database;

use App\Actions\Database\Import;
use Illuminate\Console\Command;

class ImportDatabase extends Command
{
    protected $signature = 'db:import
                            {--filePath= : Path to the backup file}
                            {--table= : Table to import (optional)}';

    protected $description = 'Restore database with data from a backup file';

    public function handle(Import $action)
    {
        $filePath = $this->option('filePath');

        if (empty($filePath)) {
            $this->error('File path is required');
            return;
        }


        $table = $this->option('table') ?? null;

        $action->handle($filePath, $table);
    }
}
