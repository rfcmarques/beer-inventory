<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Enums\StatisticsCacheKeys;
use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Country;
use App\Models\Item;
use App\Models\Style;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public function render(): View
    {
        return view('livewire.dashboard.index', [
            'totals' => $this->totals(),
            'expiringSoon' => $this->expiringSoon(),
        ]);
    }

    #[Computed()]
    protected function totals(): array
    {
        return [
            'items' => $this->getItemsTotals(),
            'beers' => $this->getBeersTotals(),
            'breweries' => $this->getBreweriesTotals(),
            'styles' => $this->getStylesTotals(),
            'countries' => $this->getCountriesTotals(),
            'liters' => $this->getLitersTotals(),
            'lastBeersConsumed' => $this->getLastBeersConsumed(),
            'beersConsumed' => $this->getBeersConsumed(),
            'charts' => $this->getChartsData(),
        ];
    }

    protected function getChartsData(): array
    {
        return [
            'breweries' => [
                'available' => $this->getTopBreweries('available'),
                'consumed' => $this->getTopBreweries('consumed'),
            ],
            'styles' => [
                'available' => $this->getTopStyles('available'),
                'consumed' => $this->getTopStyles('consumed'),
            ],
        ];
    }

    protected function getTopBreweries(string $type): array
    {
        return Cache::rememberForever(
            StatisticsCacheKeys::getTopKey('breweries', $type)->value,
            fn() => Item::query()
                ->when($type === 'available', fn($q) => $q->available())
                ->when($type === 'consumed', fn($q) => $q->consumed())
                ->join('beers', 'items.beer_id', '=', 'beers.id')
                ->join('breweries', 'beers.brewery_id', '=', 'breweries.id')
                ->select('breweries.name', DB::raw('count(*) as count'))
                ->groupBy('breweries.id', 'breweries.name')
                ->orderByDesc('count')
                ->limit(5)
                ->pluck('count', 'breweries.name')
                ->toArray()
        );
    }

    protected function getTopStyles(string $type): array
    {
        return Cache::rememberForever(
            StatisticsCacheKeys::getTopKey('styles', $type)->value,
            fn() => Item::query()
                ->when($type === 'available', fn($q) => $q->available())
                ->when($type === 'consumed', fn($q) => $q->consumed())
                ->join('beers', 'items.beer_id', '=', 'beers.id')
                ->join('styles', 'beers.style_id', '=', 'styles.id')
                ->select('styles.name', DB::raw('count(*) as count'))
                ->groupBy('styles.id', 'styles.name')
                ->orderByDesc('count')
                ->limit(5)
                ->pluck('count', 'styles.name')
                ->toArray()
        );
    }

    #[Computed()]
    protected function expiringSoon(): Collection
    {
        return Cache::rememberForever(
            key: StatisticsCacheKeys::EXPIRING_SOON->value,
            callback: fn() => Item::with('beer')
                ->with('beer.brewery')
                ->expiringSoon()
                ->limit(6)
                ->get()
        );
    }

    protected function getItemsTotals(): array
    {
        $itemsConsumed = Cache::rememberForever(
            key: StatisticsCacheKeys::ITEMS_CONSUMED->value,
            callback: fn() => Item::consumed()->count()
        );

        $itemsAvailable = Cache::rememberForever(
            key: StatisticsCacheKeys::ITEMS_AVAILABLE->value,
            callback: fn() => Item::available()->count()
        );

        return [
            'consumed' => $itemsConsumed,
            'available' => $itemsAvailable,
        ];
    }

    protected function getBeersTotals(): array
    {
        $beersConsumed = Cache::rememberForever(
            key: StatisticsCacheKeys::BEERS_CONSUMED->value,
            callback: fn() => Beer::consumed()->count()
        );

        $beersAvailable = Cache::rememberForever(
            key: StatisticsCacheKeys::BEERS_AVAILABLE->value,
            callback: fn() => Beer::available()->count()
        );

        return [
            'consumed' => $beersConsumed,
            'available' => $beersAvailable,
        ];
    }

    protected function getBreweriesTotals(): array
    {
        $breweriesConsumed = Cache::rememberForever(
            key: StatisticsCacheKeys::BREWERIES_CONSUMED->value,
            callback: fn() => Brewery::consumed()->count()
        );

        $breweriesAvailable = Cache::rememberForever(
            key: StatisticsCacheKeys::BREWERIES_AVAILABLE->value,
            callback: fn() => Brewery::available()->count()
        );

        return [
            'consumed' => $breweriesConsumed,
            'available' => $breweriesAvailable,
        ];
    }

    protected function getStylesTotals(): array
    {
        $stylesConsumed = Cache::rememberForever(
            key: StatisticsCacheKeys::STYLES_CONSUMED->value,
            callback: fn() => Style::consumed()->count()
        );

        $stylesAvailable = Cache::rememberForever(
            key: StatisticsCacheKeys::STYLES_AVAILABLE->value,
            callback: fn() => Style::available()->count()
        );

        return [
            'consumed' => $stylesConsumed,
            'available' => $stylesAvailable,
        ];
    }

    protected function getCountriesTotals(): array
    {
        $countriesConsumed = Cache::rememberForever(
            key: StatisticsCacheKeys::COUNTRIES_CONSUMED->value,
            callback: fn() => Country::consumed()->count()
        );

        $countriesAvailable = Cache::rememberForever(
            key: StatisticsCacheKeys::COUNTRIES_AVAILABLE->value,
            callback: fn() => Country::available()->count()
        );

        return [
            'consumed' => $countriesConsumed,
            'available' => $countriesAvailable,
        ];
    }

    protected function getLitersTotals(): array
    {
        $litersConsumed = Cache::rememberForever(
            key: StatisticsCacheKeys::LITERS_CONSUMED->value,
            callback: fn() => round(
                num: Item::join('containers', 'items.container_id', 'containers.id')
                    ->consumed()->sum('containers.capacity') / 1000,
                precision: 0,
                mode: PHP_ROUND_HALF_UP
            )
        );

        $litersAvailable = Cache::rememberForever(
            key: StatisticsCacheKeys::LITERS_AVAILABLE->value,
            callback: fn() => round(
                num: Item::join('containers', 'items.container_id', 'containers.id')
                    ->available()->sum('containers.capacity') / 1000,
                precision: 0,
                mode: PHP_ROUND_HALF_UP
            )
        );

        return [
            'consumed' => $litersConsumed,
            'available' => $litersAvailable,
        ];
    }

    protected function getLastBeersConsumed(): array
    {
        return Cache::rememberForever(
            key: StatisticsCacheKeys::LAST_BEERS_CONSUMED->value,
            callback: fn() => Item::with('beer')
                ->consumed()
                ->orderBy('consumed_at', 'desc')
                ->limit(3)
                ->get('beer_id')
                ->pluck('beer.name')
                ->toArray()
        );
    }

    protected function getBeersConsumed(): array
    {
        $week = Cache::rememberForever(
            key: StatisticsCacheKeys::BEERS_CONSUMED_PER_WEEK->value,
            callback: fn() => Item::consumedLastWeek()->count()
        );

        $month = Cache::rememberForever(
            key: StatisticsCacheKeys::BEERS_CONSUMED_PER_MONTH->value,
            callback: fn() => Item::consumedLastMonth()->count()
        );

        $year = Cache::rememberForever(
            key: StatisticsCacheKeys::BEERS_CONSUMED_PER_YEAR->value,
            callback: fn() => Item::consumedLastYear()->count()
        );

        return [
            'week' => $week,
            'month' => $month,
            'year' => $year,
        ];
    }
}
