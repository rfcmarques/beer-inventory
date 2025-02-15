<?php

namespace App\Http\Controllers;

use App\Livewire\Breweries;
use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Item;
use App\Models\Style;
use App\Enums\ContainerType;
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

        $meanTimeToConsume = Cache::rememberForever(
            'mean-time-to-consume',
            fn() => $this->getMeanTimeToConsume()
        );

        $lastBeersConsumed = Cache::rememberForever(
            'last-beers-consumed',
            fn() => Item::consumed()->with('beer')->orderBy('consumed_at', 'desc')->limit(3)->get('beer_id')->pluck('beer.name')->toArray()
        );

        $expiringBeers = Cache::rememberForever(
            'expiring-beers',
            fn() => Item::expiringSoon()->limit(10)->get()
        );

        $availableBreweriesTop5 = Cache::rememberForever(
            'top-5-available-breweries',
            fn() => Brewery::withAvailableItemsCount()->sortByDesc('available_items')->select(['name', 'available_items'])->take(5)
        );

        $consumedBreweriesTop5 = Cache::rememberForever(
            'top-5-consumed-breweries',
            fn() => Brewery::withConsumedItemsCount()->sortByDesc('consumed_items')->select(['name', 'consumed_items'])->take(5)
        );

        $availableStylesTop5 = Cache::rememberForever(
            'top-5-available-styles',
            fn() => Style::withAvailableItemsCount()->sortByDesc('available_items')->select(['name', 'available_items'])->take(5)
        );

        $consumedStylesTop5 = Cache::rememberForever(
            'top-5-consumed-styles',
            fn() => Style::withConsumedItemsCount()->sortByDesc('consumed_items')->select(['name', 'consumed_items'])->take(5)
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
            ->with('meanTimeToConsume', $meanTimeToConsume)
            ->with('lastBeersConsumed', $lastBeersConsumed)
            ->with('expirignBeers', $expiringBeers)
            ->with('availableBreweriesTop5', $availableBreweriesTop5)
            ->with('consumedBreweriesTop5', $consumedBreweriesTop5)
            ->with('availableStylesTop5', $availableStylesTop5)
            ->with('consumedStylesTop5', $consumedStylesTop5)
            ->with('addedByDate', $addedByDate)
            ->with('consumedByDate', $consumedByDate)
            ->with('breweriesContribution', $breweriesContribution)
            ->with('styleContribution', $styleContribution);
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
