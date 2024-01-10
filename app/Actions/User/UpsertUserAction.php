<?php

namespace App\Actions\User;

use App\DataTransferObjects\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpsertUserAction

{
    public function handle(UserData $data, User $user = null): void
    {
        User::updateOrCreate(
            [
                'id' => $user?->id,
            ],
            [
                'name' => $data->name,
                'email' => $data->email,
                'is_admin' => $data->is_admin ?? 0,
                'password' => $data->password ? Hash::make($data->password) : $user->password,
            ]
        );
    }
}

