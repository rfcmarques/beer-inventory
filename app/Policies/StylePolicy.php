<?php

namespace App\Policies;

use App\Models\Style;
use App\Models\User;

class StylePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Style $style): bool
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

    public function update(User $user, Style $style): bool
    {
        return $user->admin;
    }

    public function delete(User $user, Style $style): bool
    {
        return $user->admin;
    }
}
