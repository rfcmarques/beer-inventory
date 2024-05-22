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
    protected $signature = 'db:backup';

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
    public function handle()
    {
        $backupData = [];

        foreach ($this->tables as $tableName) {
            if ($this->tableExists($tableName)) {
                $data = DB::table($tableName)->get();
                $backupData[$tableName] = $data;
            }
        }

        // Convert data to JSON
        $jsonBackup = json_encode($backupData, JSON_PRETTY_PRINT);

        // Save JSON to file
        $filename = 'backup_' . date('Y_m_d_H_i_s') . '.json';
        Storage::disk('local')->put($filename, $jsonBackup);

        $this->info('Database backup created successfully!');
    }

    /**
     * Check if a table exists in the database.
     *
     * @param string $tableName
     * @return bool
     */
    private function tableExists($tableName)
    {
        return Schema::hasTable($tableName);
    }
}
