<?php

namespace App\Enums;

enum BeerSortingOption: string
{
    case CREATED_AT_ASC = 'created_at_asc';
    case CREATED_AT_DESC = 'created_at_desc';
    case NAME_ASC = 'name_asc';
    case NAME_DESC = 'name_desc';
    case ABV_ASC = 'abv_asc';
    case ABV_DESC = 'abv_desc';
    case BREWERY_ASC = 'brewery_asc';
    case BREWERY_DESC = 'brewery_desc';
    case STYLE_ASC = 'style_asc';
    case STYLE_DESC = 'style_desc';

    public function column(): string
    {
        return match ($this) {
            self::CREATED_AT_ASC, self::CREATED_AT_DESC => 'created_at',
            self::NAME_ASC, self::NAME_DESC => 'name',
            self::ABV_ASC, self::ABV_DESC => 'abv',
            self::BREWERY_ASC, self::BREWERY_DESC => 'brewery_id',
            self::STYLE_ASC, self::STYLE_DESC => 'style_id',
        };
    }

    public function direction(): string
    {
        return str_ends_with($this->value, '_asc') ? 'asc' : 'desc';
    }

    public function label(): string
    {
        return match ($this) {
            self::CREATED_AT_ASC => 'Oldest',
            self::CREATED_AT_DESC => 'Newest',
            self::NAME_ASC => 'Name (A-Z)',
            self::NAME_DESC => 'Name (Z-A)',
            self::ABV_ASC => 'Lower ABV',
            self::ABV_DESC => 'Higher ABV',
            self::BREWERY_ASC => 'Brewery (A-Z)',
            self::BREWERY_DESC => 'Brewery (Z-A)',
            self::STYLE_ASC => 'Style (A-Z)',
            self::STYLE_DESC => 'Style (Z-A)',
        };
    }

    public function isBrewery(): bool
    {
        return in_array($this, [self::BREWERY_ASC, self::BREWERY_DESC]);
    }

    public function isStyle(): bool
    {
        return in_array($this, [self::STYLE_ASC, self::STYLE_DESC]);
    }
}
