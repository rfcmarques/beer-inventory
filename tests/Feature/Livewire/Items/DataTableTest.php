<?php

use App\Livewire\Items\DataTable;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(DataTable::class)
        ->assertStatus(200);
});

it('searches for beer name and returns correct items (available only)', function () {
    // Arrange
    $beer = \App\Models\Beer::factory()->create(['name' => 'Larkin']);

    // Create one available item
    \App\Models\Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => null,
    ]);

    // Create one consumed item
    \App\Models\Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => now(),
    ]);

    // Act & Assert
    // Search for "Larkin"
    Livewire::test(DataTable::class)
        ->set('search', 'Larkin')
        ->assertViewHas('items', function ($items) {
            // We expect only the 1 available item to be returned now.
            return $items->count() === 1;
        });
});

it('checks for duplicates when searching', function () {
    // Arrange
    $beer = \App\Models\Beer::factory()->create(['name' => 'UniqueBeerName']);

    // Create ONLY ONE item total
    \App\Models\Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => null,
    ]);

    // Act & Assert
    Livewire::test(DataTable::class)
        ->set('search', 'UniqueBeerName')
        ->assertViewHas('items', function ($items) {
            return $items->count() === 1;
        });
});

it('searches for brewery name and does not return consumed items (precedence check)', function () {
    // Arrange
    $brewery = \App\Models\Brewery::factory()->create(['name' => 'LarkinBrewery']);
    $beer = \App\Models\Beer::factory()->create(['brewery_id' => $brewery->id]);

    // Create one available item
    \App\Models\Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => null,
    ]);

    // Create one consumed item
    \App\Models\Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => now(),
    ]);

    // Act & Assert
    // Search for "Larkin" (matches Brewery)
    Livewire::test(DataTable::class)
        ->set('search', 'Larkin')
        ->assertViewHas('items', function ($items) {
            return $items->count() === 1;
        });
});
