<?php

declare(strict_types=1);

namespace App\Enums;

enum StatisticsCacheKeys: string
{
    case ITEMS_CONSUMED = 'items-consumed';
    case ITEMS_AVAILABLE = 'items-available';
    case BEERS_CONSUMED = 'beers-consumed';
    case BEERS_AVAILABLE = 'beers-available';
    case BREWERIES_CONSUMED = 'breweries-consumed';
    case BREWERIES_AVAILABLE = 'breweries-available';
    case STYLES_CONSUMED = 'styles-consumed';
    case STYLES_AVAILABLE = 'styles-available';
    case COUNTRIES_CONSUMED = 'countries-consumed';
    case COUNTRIES_AVAILABLE = 'countries-available';
    case LITERS_CONSUMED = 'liters-consumed';
    case LITERS_AVAILABLE = 'liters-available';
    case EXPIRING_SOON = 'expiring-soon';
    case LAST_BEERS_CONSUMED = 'last-beers-consumed';
    case BEERS_CONSUMED_PER_WEEK = 'beers-consumed-per-week';
    case BEERS_CONSUMED_PER_MONTH = 'beers-consumed-per-month';
    case BEERS_CONSUMED_PER_YEAR = 'beers-consumed-per-year';
    case TOP_BREWERIES_CONSUMED = 'top-breweries-consumed';
    case TOP_BREWERIES_AVAILABLE = 'top-breweries-available';
    case TOP_STYLES_CONSUMED = 'top-styles-consumed';
    case TOP_STYLES_AVAILABLE = 'top-styles-available';

    public static function getTopKey(string $model, string $type): self
    {
        return self::tryFrom("top-{$model}-{$type}")
            ?? throw new \InvalidArgumentException("Invalid model or type: {$model} - {$type}");
    }

    public static function forItem(): array
    {
        return [
            self::ITEMS_AVAILABLE->value,
            self::ITEMS_CONSUMED->value,
            self::EXPIRING_SOON->value,
            self::LITERS_AVAILABLE->value,
            self::LITERS_CONSUMED->value,
            self::LAST_BEERS_CONSUMED->value,
            self::BEERS_CONSUMED_PER_WEEK->value,
            self::BEERS_CONSUMED_PER_MONTH->value,
            self::BEERS_CONSUMED_PER_YEAR->value,
            self::TOP_BREWERIES_CONSUMED->value,
            self::TOP_BREWERIES_AVAILABLE->value,
            self::TOP_STYLES_CONSUMED->value,
            self::TOP_STYLES_AVAILABLE->value,
        ];
    }

    public static function forBeer(): array
    {
        return [
            self::LAST_BEERS_CONSUMED->value,
            self::TOP_BREWERIES_AVAILABLE->value,
            self::TOP_BREWERIES_CONSUMED->value,
            self::TOP_STYLES_AVAILABLE->value,
            self::TOP_STYLES_CONSUMED->value,
            self::BEERS_AVAILABLE->value,
            self::BEERS_CONSUMED->value,
        ];
    }

    public static function forBrewery(): array
    {
        return [
            self::BREWERIES_AVAILABLE->value,
            self::BREWERIES_CONSUMED->value,
            self::TOP_BREWERIES_AVAILABLE->value,
            self::TOP_BREWERIES_CONSUMED->value,
        ];
    }

    public static function forStyle(): array
    {
        return [
            self::STYLES_AVAILABLE->value,
            self::STYLES_CONSUMED->value,
            self::TOP_STYLES_AVAILABLE->value,
            self::TOP_STYLES_CONSUMED->value,
        ];
    }

    public static function forContainer(): array
    {
        return [
            self::LITERS_AVAILABLE->value,
            self::LITERS_CONSUMED->value,
        ];
    }

    public static function forCountry(): array
    {
        return [
            self::COUNTRIES_AVAILABLE->value,
            self::COUNTRIES_CONSUMED->value,
        ];
    }
}
