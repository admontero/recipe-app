<?php

namespace App\Traits;

use App\Models\User;

trait Validation
{
    public function isLastAdmin(User $user, bool $isStillAdmin = false): bool
    {
        return User::where('is_admin', 1)->count() === 1 && $user->is(auth()->user()) && ! $isStillAdmin;
    }
}
