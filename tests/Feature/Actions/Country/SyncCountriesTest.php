<?php

declare(strict_types=1);

use App\Actions\Country\SyncCountries;
use App\Models\Country;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

function apiCountry(string $code, string $name, string $officialName, ?string $capital, string $flagUrl): array
{
    return [
        'name' => ['common' => $name, 'official' => $officialName],
        'cca2' => $code,
        'capital' => $capital ? [$capital] : [],
        'flags' => ['svg' => $flagUrl],
    ];
}

it('should create new countries when the table is empty', function () {
    Http::fake([
        'restcountries.com/v3.1/all*' => Http::response([
            apiCountry('PT', 'Portugal', 'Portuguese Republic', 'Lisbon', 'https://pt-flag.svg'),
            apiCountry('ES', 'Spain', 'Kingdom of Spain', 'Madrid', 'https://es-flag.svg'),
        ]),
    ]);

    Log::spy();

    app(SyncCountries::class)->handle();

    expect(Country::count())->toBe(2);

    $portugal = Country::where('code', 'PT')->first();

    expect($portugal)
        ->name->toBe('Portugal')
        ->official_name->toBe('Portuguese Republic')
        ->capital->toBe('Lisbon')
        ->flag_url->toBe('https://pt-flag.svg');
});

it('should do nothing when data is identical', function () {
    Country::factory()->create([
        'code' => 'PT',
        'name' => 'Portugal',
        'official_name' => 'Portuguese Republic',
        'capital' => 'Lisbon',
        'flag_url' => 'https://pt-flag.svg',
    ]);

    Http::fake([
        'restcountries.com/v3.1/all*' => Http::response([
            apiCountry('PT', 'Portugal', 'Portuguese Republic', 'Lisbon', 'https://pt-flag.svg'),
        ]),
    ]);

    Log::spy();

    app(SyncCountries::class)->handle();

    expect(Country::count())->toBe(1);

    Log::shouldHaveReceived('info')
        ->with('No countries to sync')
        ->once();
});

it('should update a country when a field changes', function () {
    Country::factory()->create([
        'code' => 'PT',
        'name' => 'Portugal',
        'official_name' => 'Portuguese Republic',
        'capital' => 'Old Capital',
        'flag_url' => 'https://pt-flag.svg',
    ]);

    Http::fake([
        'restcountries.com/v3.1/all*' => Http::response([
            apiCountry('PT', 'Portugal', 'Portuguese Republic', 'Lisbon', 'https://pt-flag.svg'),
        ]),
    ]);

    Log::spy();

    app(SyncCountries::class)->handle();

    expect(Country::where('code', 'PT')->first())
        ->capital->toBe('Lisbon');
});

it('should create new and updates existing countries in a single handle', function () {
    Country::factory()->create([
        'code' => 'PT',
        'name' => 'Portugal',
        'official_name' => 'Portuguese Republic',
        'capital' => 'Old Capital',
        'flag_url' => 'https://pt-flag.svg',
    ]);

    Http::fake([
        'restcountries.com/v3.1/all*' => Http::response([
            apiCountry('PT', 'Portugal', 'Portuguese Republic', 'Lisbon', 'https://pt-flag.svg'),
            apiCountry('ES', 'Spain', 'Kingdom of Spain', 'Madrid', 'https://es-flag.svg'),
        ]),
    ]);

    Log::spy();

    app(SyncCountries::class)->handle();

    expect(Country::count())->toBe(2)
        ->and(Country::where('code', 'PT')->first()->capital)->toBe('Lisbon')
        ->and(Country::where('code', 'ES')->first()->name)->toBe('Spain');
});

it('should handle chunking with more than 100 countries', function () {
    $apiData = collect(range(1, 150))->map(function (int $i) {
        $code = strtoupper(substr(md5((string) $i), 0, 2));

        return apiCountry($code, "Country {$i}", "Official {$i}", "Capital {$i}", "https://flag-{$i}.svg");
    })->unique(fn (array $c) => $c['cca2'])->values()->all();

    Http::fake([
        'restcountries.com/v3.1/all*' => Http::response($apiData),
    ]);

    Log::spy();

    app(SyncCountries::class)->handle();

    expect(Country::count())->toBe(count($apiData));
});

it('should throw an exception and logs error when client fails', function () {
    Http::fake([
        'restcountries.com/v3.1/all*' => Http::response(null, 500),
    ]);

    Log::spy();

    try {
        app(SyncCountries::class)->handle();
    } catch (RequestException $e) {
        Log::shouldHaveReceived('error')
            ->with(Mockery::on(fn (string $msg) => str_contains($msg, 'Countries sync failed')))
            ->once();

        throw $e;
    }
})->throws(RequestException::class);
