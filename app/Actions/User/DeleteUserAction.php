<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeleteUserAction
{
    public function handle(User $user): void
    {
        $isLogged = $user->is(auth()->user());

        if ($isLogged) Auth::logout();

        $user->delete();

        if ($isLogged) {
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }
    }
}
