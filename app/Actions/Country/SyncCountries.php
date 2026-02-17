<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use App\Services\RestCountries\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Throwable;

final readonly class SyncCountries
{
    public function __construct(
        protected Client $client,
    ) {
    }

    public function handle(): void
    {
        try {
            $apiCountries = $this->client->fetchAll();

            $existingCountries = Country::query()
                ->select(['code', 'name', 'official_name', 'capital', 'flag_url'])
                ->get()
                ->keyBy('code');


            $countriesToSync = $apiCountries->filter(function ($dto) use ($existingCountries) {
                $existing = $existingCountries->get($dto->code);

                if (!$existing)
                    return true;

                return $existing->name !== $dto->name
                    || $existing->official_name !== $dto->officialName
                    || $existing->capital !== $dto->capital
                    || $existing->flag_url !== $dto->flagUrl;
            });

            if ($countriesToSync->isEmpty()) {
                Log::info('No countries to sync');
                return;
            }

            $countriesToSync->chunk(100)->each(function (Collection $chunk) {
                $dataToUpsert = $chunk->map(fn($dto) => [
                    ...$dto->toArray(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ])->all();

                Country::upsert(
                    values: $dataToUpsert,
                    uniqueBy: ['code'],
                    update: ['name', 'official_name', 'capital', 'flag_url', 'updated_at']
                );
            });

            Log::info("Countries synchronization completed");
            Log::info("Countries created/updated: " . $countriesToSync->count());
        } catch (Throwable $th) {
            Log::error("Countries sync failed: " . $th->getMessage());
            throw $th;
        }
    }
}