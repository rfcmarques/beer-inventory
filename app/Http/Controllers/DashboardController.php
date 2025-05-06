<?php

namespace App\Http\Controllers;

use App\DTOs\BarGraphDto;
use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Item;
use App\Models\Style;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $itemsConsumed = Cache::rememberForever(
            'items-consumed',
            fn() => Item::consumed()->count()
        );

        $itemsAvailable = Cache::rememberForever(
            'items-available',
            fn() =>  Item::available()->count()
        );

        $beersAvailable = Cache::rememberForever(
            'beers-available',
            fn() => Beer::available()->count()
        );

        $beersConsumed = Cache::rememberForever(
            'beers-consumed',
            fn() => Beer::consumed()->count()
        );

        $breweriesAvailable = Cache::rememberForever(
            'breweries-available',
            fn() => Brewery::withAvailableItems()->count()
        );

        $breweriesConsumed = Cache::rememberForever(
            'breweries-consumed',
            fn() => Brewery::withConsumedItems()->count()
        );

        $stylesAvailable = Cache::rememberForever(
            'styles-available',
            fn() => Style::withAvailableItems()->count()
        );

        $stylesConsumed = Cache::rememberForever(
            'styles-consumed',
            fn() => Style::withConsumedItems()->count()
        );

        $countriesAvailable = Cache::rememberForever(
            'countries-available',
            fn() => Country::withAvailableItems()->count()
        );

        $countriesConsumed = Cache::rememberForever(
            'countries-consumed',
            fn() => Country::withConsumedItems()->count()
        );

        $litersAvailable = (int) round(
            num: Cache::rememberForever(
                'liters-available',
                fn() => Item::available()
                    ->join('containers', 'containers.id', '=', 'items.container_id')
                    ->sum('containers.capacity') / 1000
            ),
            mode: PHP_ROUND_HALF_UP
        );

        $litersConsumed = (int) round(
            num: Cache::rememberForever(
                'liters-consumed',
                fn() => Item::consumed()
                    ->join('containers', 'containers.id', '=', 'items.container_id')
                    ->sum('containers.capacity') / 1000
            ),
            mode: PHP_ROUND_HALF_UP
        );

        $meanTimeToConsume = Cache::rememberForever(
            'mean-time-to-consume',
            fn() => $this->getMeanTimeToConsume()
        );

        $lastBeersConsumed = Cache::rememberForever(
            'last-beers-consumed',
            fn() => Item::consumed()->with('beer')->orderBy('consumed_at', 'desc')->limit(3)->get('beer_id')->pluck('beer.name')->toArray()
        );

        // number of items consumed per week
        $itemsConsumedPerWeek = Cache::rememberForever(
            'items-consumed-per-week',
            fn() => Item::consumed()
                ->where('consumed_at', '>=', now()->subWeek())
                ->count()
        );

        // number of items consumed per month
        $itemsConsumedPerMonth = Cache::rememberForever(
            'items-consumed-per-month',
            fn() => Item::consumed()
                ->where('consumed_at', '>=', now()->subMonth())
                ->count()
        );

        // number of items consumed per year
        $itemsConsumedPerYear = Cache::rememberForever(
            'items-consumed-per-year',
            fn() => Item::consumed()
                ->where('consumed_at', '>=', now()->subYear())
                ->count()
        );

        $expiringBeers = Cache::rememberForever(
            'expiring-beers',
            fn() => Item::expiringSoon()->limit(5)->get()
        );

        $availableBreweriesTop5 = Cache::rememberForever(
            'top-5-available-breweries',
            fn() => Brewery::withAvailableItemsCount()->sortByDesc('available_items')->select(['name', 'available_items'])->take(5)
        );

        $availableBreweriesTop5Dataset = new BarGraphDto(
            label: 'Available',
            items: $availableBreweriesTop5,
            valueField: 'available_items',
            bgColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
        );

        $consumedBreweriesTop5 = Cache::rememberForever(
            'top-5-consumed-breweries',
            fn() => Brewery::withConsumedItemsCount()->sortByDesc('consumed_items')->select(['name', 'consumed_items'])->take(5)
        );

        $consumedBreweriesTop5Dataset = new BarGraphDto(
            label: 'Consumed',
            items: $consumedBreweriesTop5,
            valueField: 'consumed_items',
            bgColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
        );

        $availableStylesTop5 = Cache::rememberForever(
            'top-5-available-styles',
            fn() => Style::withAvailableItemsCount()->sortByDesc('available_items')->select(['name', 'available_items'])->take(5)
        );

        $availableStylesTop5Dataset = new BarGraphDto(
            label: 'Available',
            items: $availableStylesTop5,
            valueField: 'available_items',
            bgColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
        );

        $consumedStylesTop5 = Cache::rememberForever(
            'top-5-consumed-styles',
            fn() => Style::withConsumedItemsCount()->sortByDesc('consumed_items')->select(['name', 'consumed_items'])->take(5)
        );

        $consumedStylesTop5Dataset = new BarGraphDto(
            label: 'Consumed',
            items: $consumedStylesTop5,
            valueField: 'consumed_items',
            bgColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
        );

        $addedByDate = Item::selectRaw('strftime("%Y-%m", created_at) as month, COUNT(*) as added_count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $consumedByDate = Item::selectRaw('strftime("%Y-%m", consumed_at) as month, COUNT(*) as consumed_count')
            ->whereNotNull('consumed_at')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $breweriesContribution = Brewery::withAvailableItemsCount()
            ->map(function ($brewery) {
                return [
                    'name' => $brewery->name,
                    'available_items' => $brewery->available_items,
                ];
            })
            ->sortByDesc('available_items')
            ->take(20);

        $styleContribution = Style::withAvailableItemsCount()
            ->map(function ($style) {
                return [
                    'name' => $style->name,
                    'available_items' => $style->available_items,
                ];
            })
            ->sortByDesc('available_items')
            ->take(20);

        return view('home.index')
            ->with('itemsAvailable', $itemsAvailable)
            ->with('itemsConsumed', $itemsConsumed)
            ->with('beersAvailable', $beersAvailable)
            ->with('beersConsumed', $beersConsumed)
            ->with('breweriesAvailable', $breweriesAvailable)
            ->with('breweriesConsumed', $breweriesConsumed)
            ->with('stylesAvailable', $stylesAvailable)
            ->with('stylesConsumed', $stylesConsumed)
            ->with('countriesAvailable', $countriesAvailable)
            ->with('countriesConsumed', $countriesConsumed)
            ->with('litersAvailable', $litersAvailable)
            ->with('litersConsumed', $litersConsumed)
            ->with('meanTimeToConsume', $meanTimeToConsume)
            ->with('lastBeersConsumed', $lastBeersConsumed)
            ->with('itemsConsumedPerWeek', $itemsConsumedPerWeek)
            ->with('itemsConsumedPerMonth', $itemsConsumedPerMonth)
            ->with('itemsConsumedPerYear', $itemsConsumedPerYear)
            ->with('expirignBeers', $expiringBeers)
            // ->with('addedByDate', $addedByDate)
            // ->with('consumedByDate', $consumedByDate)
            // ->with('breweriesContribution', $breweriesContribution)
            // ->with('styleContribution', $styleContribution)
            ->with('breweriesTop5Datasets', [
                $availableBreweriesTop5Dataset,
                $consumedBreweriesTop5Dataset,
            ])
            ->with('stylesTop5Datasets', [
                $availableStylesTop5Dataset,
                $consumedStylesTop5Dataset,
            ]);
    }

    protected function getMeanTimeToConsume(): int
    {
        return (int) (Item::consumed()
            ->get(['created_at', 'consumed_at'])
            ->map(function (Item $item) {
                return $item->consumed_at->diffInDays(
                    date: $item->created_at,
                    absolute: true
                );
            })
            ->avg() ?? 0);
    }
}
