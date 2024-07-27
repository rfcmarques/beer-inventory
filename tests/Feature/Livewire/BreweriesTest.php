<?php

use App\Livewire\Breweries;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Breweries::class)
        ->assertStatus(200);
});
