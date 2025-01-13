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
    case MEAN_TIME_TO_CONSUME = 'mean-time-to-consume';
    case LAST_BEERS_CONSUMED = 'last-beers-consumed';
    case EXPIRING_BEERS = 'expiring-beers';
    case TOP_5_AVAILABLE_BREWERIES = 'top-5-available-breweries';
    case TOP_5_CONSUMED_BREWERIES = 'top-5-consumed-breweries';
    case TOP_5_AVAILABLE_STYLES = 'top-5-available-styles';
    case TOP_5_CONSUMED_STYLES = 'top-5-consumed-styles';
}
