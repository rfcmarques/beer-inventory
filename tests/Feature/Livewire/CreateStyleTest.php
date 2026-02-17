<?php

use App\Livewire\Styles\Create;
use App\Models\Style;
use Livewire\Livewire;

it('can create a new style', function () {
    Livewire::test(Create::class)
        ->set('form.name', 'IPA')
        ->set('form.srm', 10)
        ->call('save')
        ->assertHasNoErrors();

    expect(Style::where('name', 'IPA')->exists())->toBeTrue();
});

it('validates name is required', function () {
    Livewire::test(Create::class)
        ->set('form.name', '')
        ->call('save')
        ->assertHasErrors(['form.name' => 'required']);
});

it('validates name is unique', function () {
    Style::factory()->create(['name' => 'Stout']);

    Livewire::test(Create::class)
        ->set('form.name', 'Stout')
        ->call('save')
        ->assertHasErrors(['form.name' => 'unique']); // Note: Rule::unique might return 'form.name' or just 'name' depending on Livewire version, usually key is property path.
});

it('resets form after creation', function () {
    Livewire::test(Create::class)
        ->set('form.name', 'Lager')
        ->call('save')
        ->assertSet('form.name', '')
        ->assertSet('form.srm', null)
        ->assertSet('showCreateModal', false);
});

it('can load style for editing', function () {
    $style = Style::factory()->create();

    Livewire::test(Create::class)
        ->dispatch('edit-style', $style->id)
        ->assertSet('form.style.id', $style->id)
        ->assertSet('form.name', $style->name)
        ->assertSet('form.srm', $style->srm)
        ->assertSet('showCreateModal', true);
});

it('can update a style', function () {
    $style = Style::factory()->create(['name' => 'Old Name', 'srm' => 5]);

    Livewire::test(Create::class)
        ->dispatch('edit-style', $style->id)
        ->set('form.name', 'New Name')
        ->set('form.srm', 10)
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('showCreateModal', false);

    expect($style->refresh())
        ->name->toBe('New Name')
        ->srm->toBe(10);
});

it('ignores current style for unique name validation on update', function () {
    $style = Style::factory()->create(['name' => 'My Style']);

    Livewire::test(Create::class)
        ->dispatch('edit-style', $style->id)
        ->set('form.name', 'My Style')
        ->call('save')
        ->assertHasNoErrors();
});
