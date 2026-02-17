<?php

use App\Livewire\Items\ConsumptionModal;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ConsumptionModal::class)
        ->assertStatus(200);
});
