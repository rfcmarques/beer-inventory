<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Item $item): bool
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

    public function update(User $user, Item $item): bool
    {
        return $user->admin;
    }

    public function delete(User $user, Item $item): bool
    {
        return $user->admin;
    }
}
