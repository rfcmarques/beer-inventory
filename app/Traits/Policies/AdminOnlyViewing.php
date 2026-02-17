<?php

declare(strict_types=1);

namespace App\Traits\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait AdminOnlyViewing
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Model $model): bool
    {
        return $user->isAdmin();
    }
}
