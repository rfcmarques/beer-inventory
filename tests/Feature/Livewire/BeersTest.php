<?php

use App\Livewire\Beers;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Beers::class)
        ->assertStatus(200);
});
