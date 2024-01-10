<?php

namespace App\DataTransferObjects;

use App\Http\Requests\UserRequest;

class UserData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $is_admin,
        public readonly ?string $password,
    ) {}

    public static function fromRequest(UserRequest $request): self
    {
        return new static(
            name: $request->validated('name'),
            email: $request->validated('email'),
            is_admin: $request->validated('is_admin'),
            password: $request->validated('password'),
        );
    }
}
