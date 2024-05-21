<?php

namespace App\Policies;

use App\Models\Beer;
use App\Models\User;

class BeerPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Beer $beer): bool
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

    public function update(User $user, Beer $beer): bool
    {
        return $user->admin;
    }

    public function delete(User $user, Beer $beer): bool
    {
        return $user->admin;
    }
}
