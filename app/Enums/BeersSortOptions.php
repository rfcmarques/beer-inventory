<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum BeersSortOptions: string
{
    case OLDEST = 'oldest';
    case NEWEST = 'newest';
    case NAME_ASC = 'name_asc';
    case NAME_DESC = 'name_desc';
    case LOWER_ABV = 'lower_abv';
    case HIGHER_ABV = 'higher_abv';
    case BREWERY_ASC = 'brewery_asc';
    case BREWERY_DESC = 'brewery_desc';
    case STYLE_ASC = 'style_asc';
    case STYLE_DESC = 'style_desc';

    public function label(): string
    {
        return match ($this) {
            self::OLDEST => 'Oldest',
            self::NEWEST => 'Newest',
            self::NAME_ASC => 'Name (A-Z)',
            self::NAME_DESC => 'Name (Z-A)',
            self::LOWER_ABV => 'Lower ABV',
            self::HIGHER_ABV => 'Higher ABV',
            self::BREWERY_ASC => 'Brewery (A-Z)',
            self::BREWERY_DESC => 'Brewery (Z-A)',
            self::STYLE_ASC => 'Style (A-Z)',
            self::STYLE_DESC => 'Style (Z-A)',
        };
    }

    public function sortType(): string
    {
        return match ($this) {
            self::OLDEST => 'asc',
            self::NEWEST => 'desc',
            self::NAME_ASC => 'asc',
            self::NAME_DESC => 'desc',
            self::LOWER_ABV => 'asc',
            self::HIGHER_ABV => 'desc',
            self::BREWERY_ASC => 'asc',
            self::BREWERY_DESC => 'desc',
            self::STYLE_ASC => 'asc',
            self::STYLE_DESC => 'desc',
        };
    }

    public function sortColumn(): string
    {
        return match ($this) {
            self::OLDEST => 'created_at',
            self::NEWEST => 'created_at',
            self::NAME_ASC => 'name',
            self::NAME_DESC => 'name',
            self::LOWER_ABV => 'abv',
            self::HIGHER_ABV => 'abv',
            self::BREWERY_ASC => 'breweries.name',
            self::BREWERY_DESC => 'breweries.name',
            self::STYLE_ASC => 'styles.name',
            self::STYLE_DESC => 'styles.name',
        };
    }

    public static function toArray(): array
    {
        return Arr::map(self::cases(), fn(self $value) => ['id' => $value->value, 'name' => $value->label()]);
    }
}