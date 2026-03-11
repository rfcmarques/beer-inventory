<?php

declare(strict_types=1);

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Container;
use App\Models\Item;
use App\Models\Style;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('should convert model to array with expected keys', function () {
    $item = Item::factory()->create();

    expect($item->toArray())->toHaveKeys([
        'id',
        'beer_id',
        'container_id',
        'consumed_at',
        'expiration_date',
        'created_at',
        'updated_at',
    ]);
});

it('should have correct fillable attributes', function () {
    $item = new Item;

    expect($item->getFillable())->toBe([
        'beer_id',
        'container_id',
        'consumed_at',
        'expiration_date',
    ]);
});

it('should have correct casts', function () {
    $item = new Item;

    expect($item->getCasts())
        ->toHaveKey('id', 'int')
        ->toHaveKey('consumed_at', 'datetime:Y-m-d')
        ->toHaveKey('expiration_date', 'datetime:Y-m-d');
});

it('should belong to a beer', function () {
    $item = Item::factory()->create();

    expect($item->beer)->toBeInstanceOf(Beer::class);
});

it('should belong to a container', function () {
    $item = Item::factory()->create();

    expect($item->container)->toBeInstanceOf(Container::class);
});

it('should scope to available items', function () {
    Item::factory()->count(3)->create([
        'consumed_at' => null,
    ]);

    $results = Item::available()->get();

    expect($results)->toHaveCount(3)
        ->and($results->each(fn ($item) => expect($item->consumed_at)->toBeNull()));
});

it('should scope to consumed items', function () {
    Item::factory()->count(3)->create([
        'consumed_at' => now(),
    ]);

    $results = Item::consumed()->get();

    expect($results)->toHaveCount(3)
        ->and($results->each(fn ($item) => expect($item->consumed_at)->not->toBeNull()));
});

it('should scope to items expiring soon', function () {
    Item::factory()->count(3)->create([
        'consumed_at' => null,
        'expiration_date' => now()->addDays(3),
    ]);

    $results = Item::expiringSoon()->get();

    expect($results)->toHaveCount(3)
        ->and($results->each(fn ($item) => expect($item->expiration_date)->toBeBetween(now(), now()->addWeeks(2))));
});

it('should scope items consumed by consumed_at desc', function () {
    $item1 = Item::factory()->create(['consumed_at' => now()->subDays(3)]);
    $item2 = Item::factory()->create(['consumed_at' => now()->subDays(1)]);
    Item::factory()->create(['consumed_at' => now()->subDays(2)]);

    $results = Item::lastConsumed()->get();

    expect($results)->toHaveCount(3)
        ->and($results->first()->is($item2))->toBeTrue()
        ->and($results->last()->is($item1))->toBeTrue();
});

it('should scope items by consumed_at date', function () {
    Item::factory()->create(['consumed_at' => now()->subDays(3)]);
    $item2 = Item::factory()->create(['consumed_at' => now()->subDays(1)]);
    Item::factory()->create(['consumed_at' => now()->subDays(2)]);

    $results = Item::consumedAt(now()->subDays(1))->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item2))->toBeTrue();
});

it('should scope items consumed between two dates', function () {
    $item1 = Item::factory()->create(['consumed_at' => now()->subDays(2)]);
    $item2 = Item::factory()->create(['consumed_at' => now()->subDays(1)]);
    $item3 = Item::factory()->create(['consumed_at' => now()->subDays(3)]);

    $results = Item::consumedBetween(now()->subDays(2), now()->subDays(1))->get();

    expect($results)->toHaveCount(2)
        ->and($results->first()->is($item1))->toBeTrue()
        ->and($results->last()->is($item2))->toBeTrue();
});

it('should scope to items consumed during last week', function () {
    $item1 = Item::factory()->create(['consumed_at' => now()->subDays(2)]);
    $item2 = Item::factory()->create(['consumed_at' => now()->subDays(1)]);
    Item::factory()->create(['consumed_at' => now()->subWeeks(2)]);

    $results = Item::consumedLastWeek()->get();

    expect($results)->toHaveCount(2)
        ->and($results->first()->is($item1))->toBeTrue()
        ->and($results->last()->is($item2))->toBeTrue();
});

it('should scope to items consumed during last month', function () {
    $item1 = Item::factory()->create(['consumed_at' => now()->subDays(2)]);
    $item2 = Item::factory()->create(['consumed_at' => now()->subWeek()]);
    Item::factory()->create(['consumed_at' => now()->subMonths(2)]);

    $results = Item::consumedLastMonth()->get();

    expect($results)->toHaveCount(2)
        ->and($results->first()->is($item1))->toBeTrue()
        ->and($results->last()->is($item2))->toBeTrue();
});

it('should scope to items consumed during last year', function () {
    Item::factory()->create(['consumed_at' => now()->subDays(2)]);
    Item::factory()->create(['consumed_at' => now()->subWeek()]);
    $item = Item::factory()->create(['consumed_at' => now()->subYear()]);

    $results = Item::consumedLastYear()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item))->toBeTrue();
});

it('should scope to items consumed during this year', function () {
    $item1 = Item::factory()->create(['consumed_at' => now()->subDays(2)]);
    $item2 = Item::factory()->create(['consumed_at' => now()->subWeek()]);
    Item::factory()->create(['consumed_at' => now()->subYear()]);

    $results = Item::consumedThisYear()->get();

    expect($results)->toHaveCount(2)
        ->and($results->first()->is($item1))->toBeTrue()
        ->and($results->last()->is($item2))->toBeTrue();
});

it('should scope to items expiring at a given date', function () {
    $item1 = Item::factory()->create(['expiration_date' => now()->subDays(2)]);
    $item2 = Item::factory()->create(['expiration_date' => now()->subWeek()]);
    Item::factory()->create(['expiration_date' => now()->subMonths(2)]);

    $results = Item::expiringAt(now()->subWeek())->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item2))->toBeTrue();
});

it('should scope to items expiring between two dates', function () {
    $item1 = Item::factory()->create(['expiration_date' => now()->subDays(2)]);
    $item2 = Item::factory()->create(['expiration_date' => now()->subWeek()]);
    Item::factory()->create(['expiration_date' => now()->subMonths(2)]);

    $results = Item::expiringBetween(now()->subWeeks(2), now())->get();

    expect($results)->toHaveCount(2)
        ->and($results->first()->is($item1))->toBeTrue()
        ->and($results->last()->is($item2))->toBeTrue();
});

it('should scope to items expiring until the end of next week', function () {
    Item::factory()->create(['expiration_date' => now()->subDays(2)]);
    $item2 = Item::factory()->create(['expiration_date' => now()->addWeek()]);
    Item::factory()->create(['expiration_date' => now()->subMonths(2)]);

    $results = Item::expiringUntilNextWeek()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item2))->toBeTrue();
});

it('should scope to items expiring until the end of next month', function () {
    Item::factory()->create(['expiration_date' => now()->subDays(2)]);
    $item2 = Item::factory()->create(['expiration_date' => now()->addWeeks(2)]);
    Item::factory()->create(['expiration_date' => now()->subMonths(2)]);

    $results = Item::expiringUntilNextMonth()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item2))->toBeTrue();
});

it('should scope to items expiring until the end of next year', function () {
    Item::factory()->create(['expiration_date' => now()->subDays(2)]);
    $item2 = Item::factory()->create(['expiration_date' => now()->addYear()]);
    Item::factory()->create(['expiration_date' => now()->subMonths(2)]);

    $results = Item::expiringUntilNextYear()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item2))->toBeTrue();
});

it('should search items by beer name', function () {
    $beer1 = Beer::factory()->create(['name' => 'Super Bock']);
    $beer2 = Beer::factory()->create(['name' => 'Sagres']);
    $item1 = Item::factory()->create(['beer_id' => $beer1->id]);
    $item2 = Item::factory()->create(['beer_id' => $beer2->id]);

    $results = Item::search('Super Bock')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item1))->toBeTrue();

    $results = Item::search('super')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item1))->toBeTrue();

    $results = Item::search('Sagres')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item2))->toBeTrue();

    $results = Item::search('Cristal')->get();

    expect($results)->toHaveCount(0);
});

it('should search items by brewery name', function () {
    $brewery1 = Brewery::factory()->create(['name' => 'Ophiussa']);
    $brewery2 = Brewery::factory()->create(['name' => 'Dois Corvos']);

    $beer1 = Beer::factory()->create(['brewery_id' => $brewery1->id]);
    $beer2 = Beer::factory()->create(['brewery_id' => $brewery2->id]);

    $item1 = Item::factory()->create(['beer_id' => $beer1->id]);
    $item2 = Item::factory()->create(['beer_id' => $beer2->id]);

    $results = Item::search('Ophiussa')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item1))->toBeTrue();

    $results = Item::search('ophiussa')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item1))->toBeTrue();

    $results = Item::search('Dois Corvos')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item2))->toBeTrue();

    $results = Item::search('Musa')->get();

    expect($results)->toHaveCount(0);
});

it('should search items by style name', function () {
    $style1 = Style::factory()->create(['name' => 'NEIPA']);
    $style2 = Style::factory()->create(['name' => 'Imperial Stout']);

    $beer1 = Beer::factory()->create(['style_id' => $style1->id]);
    $beer2 = Beer::factory()->create(['style_id' => $style2->id]);

    $item1 = Item::factory()->create(['beer_id' => $beer1->id]);
    $item2 = Item::factory()->create(['beer_id' => $beer2->id]);

    $results = Item::search('IPA')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item1))->toBeTrue();

    $results = Item::search('neipa')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item1))->toBeTrue();

    $results = Item::search('Stout')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->is($item2))->toBeTrue();

    $results = Item::search('pils')->get();

    expect($results)->toHaveCount(0);
});
