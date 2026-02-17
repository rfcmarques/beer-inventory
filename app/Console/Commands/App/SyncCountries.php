<?php

declare(strict_types=1);

namespace App\Console\Commands\App;

use Illuminate\Console\Command;
use App\Actions\Country\SyncCountries as Action;

class SyncCountries extends Command
{
    protected $signature = 'app:sync-countries';

    protected $description = 'Sync countries list through external API from restcountries.com';

    public function handle(Action $action): int
    {
        $this->info('Syncing countries...');

        try {
            $action->handle();
            $this->info('Sync completed successfully');
            return self::SUCCESS;
        } catch (\Throwable $th) {
            $this->error('Error during sync: ' . $th->getMessage());
            return self::FAILURE;
        }
    }
}
