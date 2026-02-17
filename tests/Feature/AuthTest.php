<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('can logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect('/');

    expect(Auth::check())->toBeFalse();
});

it('redirects to home after logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect('/');
});
