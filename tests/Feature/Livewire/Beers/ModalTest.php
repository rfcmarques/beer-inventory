<?php

use App\Livewire\Beers\Modal;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Modal::class)
        ->assertStatus(200);
});
