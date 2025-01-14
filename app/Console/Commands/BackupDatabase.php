<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup
                            {--filename= : Set a custom filename}
                            {--table= : Backup a specific table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database to a JSON file';

    /**
     * List of the tables that will get a back up
     * 
     * @var array
     */
    protected $tables = [
        'users',
        'beers',
        'styles',
        'breweries',
        'items',
        'containers'
    ];

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $backupData = $this->option('table')
            ? $this->getTableData($this->option('table'))
            : $this->getDatabaseData();

        $filename = $this->setFilename();

        $this->storeBackup($backupData, $filename);

        $this->sendSuccessMessage($filename);
    }

    /**
     * Returns all the data from the database
     * stored in an array
     * 
     * @return array
     */
    private function getDatabaseData(): array
    {
        $data = [];

        foreach ($this->tables as $tableName) {
            $data[$tableName] = $this->getTableData($tableName);
        }

        return $data;
    }

    /**
     * @param string $tableName
     * @return \Illuminate\Support\Collection|void
     */
    private function getTableData($tableName)
    {
        if ($this->tableExists($tableName)) {
            return DB::table($tableName)->get();
        } else {
            $this->sendErrorMessage($tableName);
        }
    }

    /**
     * Stores the given data into a JSON file with the given filename
     * 
     * @param mixed $backupData
     * @param string $filename
     * @return void
     */
    private function storeBackup($backupData, $filename): void
    {
        // Convert data to JSON
        $jsonBackup = json_encode($backupData, JSON_PRETTY_PRINT);

        // Save JSON to file
        Storage::disk('backups')->put($filename, $jsonBackup);
    }

    /**
     * Check if a table exists in the database.
     *
     * @param string $tableName
     * @return bool
     */
    private function tableExists($tableName): bool
    {
        return Schema::hasTable($tableName);
    }

    /**
     * Write the success message
     * 
     * @param string $filename
     * @return void
     */
    private function sendSuccessMessage($filename): void
    {
        $this->line('');

        $this->info("   \033[42m SUCCESS \033[0m Database backup created successfully!");

        $this->line('');

        $backupPath = Storage::url("app/backups/$filename");
        $this->info("   \033[44m INFO \033[0m Backup is stored at \033[1m[<href=file://$backupPath>{$backupPath}]\033[0m</>");

        $this->line('');
    }

    /**
     * Writes an error message and ends the command
     * 
     * @param string $tableName
     * @return void
     */
    private function sendErrorMessage($tableName): void
    {
        $this->line('');

        $this->info("   \033[41m ERROR \033[0m Table '$tableName' does not exist!");

        $this->line('');

        exit;
    }

    /**
     * Define the file name based on the option,
     * if there is no option defined uses the default
     * 
     * @return string
     */
    private function setFilename(): string
    {
        if ($this->option('filename')) {
            return $this->option('filename') . '.json';
        }

        if ($this->option('table')) {
            return $this->option('table') . '_backup_' . date('Y_m_d_H_i_s') . '.json';
        }

        return 'backup_' . date('Y_m_d_H_i_s') . '.json';
    }
}
