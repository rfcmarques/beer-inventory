<?php

namespace App\Policies;

use App\Models\Brewery;
use App\Models\User;

class BreweryPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Brewery $brewery): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->admin;
    }

    public function edit(User $user): bool
    {
        return $user->admin;
    }

    public function update(User $user, Brewery $brewery): bool
    {
        return $user->admin;
    }

    public function delete(User $user, Brewery $brewery): bool
    {
        return $user->admin;
    }
}
