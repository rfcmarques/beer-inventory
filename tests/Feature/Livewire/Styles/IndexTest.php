<?php

use App\Livewire\Styles\Index;
use App\Models\Style;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Index::class)
        ->assertStatus(200);
});

it('can delete a style', function () {
    $style = Style::factory()->create();

    Livewire::test(Index::class)
        ->call('delete', $style->id);

    expect(Style::find($style->id))->toBeNull();
});
