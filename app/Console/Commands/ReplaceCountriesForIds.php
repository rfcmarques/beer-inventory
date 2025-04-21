<?php

namespace App\Console\Commands;

use App\Actions\Breweries\ReplaceCountriesForIds as ReplaceCountriesForIdsAction;
use App\Models\Brewery;
use App\Models\Country;
use Illuminate\Console\Command;

class ReplaceCountriesForIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:replace-countries-for-ids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command replaces the country name for an id in the breweries table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Replacing countries for ids...');

        foreach (Brewery::all() as $brewery) {
            $country = Country::where('name', $brewery->country)->first();

            $handler = new ReplaceCountriesForIdsAction($brewery, $country);
            $handler->handle();
        }

        $this->info('Countries replaced successfully!');
    }
}
