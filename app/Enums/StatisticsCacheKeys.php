<?php

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
    case COUNTRIES_AVAILABLE = 'countries-available';
    case COUNTRIES_CONSUMED = 'countries-consumed';
    case LITERS_CONSUMED = 'liters-consumed';
    case LITERS_AVAILABLE = 'liters-available';
    case MEAN_TIME_TO_CONSUME = 'mean-time-to-consume';
    case LAST_BEERS_CONSUMED = 'last-beers-consumed';
    case ITEMS_CONSUMED_PER_WEEK = 'items-consumed-per-week';
    case ITEMS_CONSUMED_PER_MONTH = 'items-consumed-per-month';
    case ITEMS_CONSUMED_PER_YEAR = 'items-consumed-per-year';
    case EXPIRING_BEERS = 'expiring-beers';
    case TOP_5_AVAILABLE_BREWERIES = 'top-5-available-breweries';
    case TOP_5_CONSUMED_BREWERIES = 'top-5-consumed-breweries';
    case TOP_5_AVAILABLE_STYLES = 'top-5-available-styles';
    case TOP_5_CONSUMED_STYLES = 'top-5-consumed-styles';
}
