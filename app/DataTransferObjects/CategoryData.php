<?php

namespace App\DataTransferObjects;

use App\Http\Requests\CategoryRequest;

class CategoryData
{
    public function __construct(
        public readonly string $name,
    ) {}

    public static function fromRequest(CategoryRequest $request): self
    {
        return new static(
            name: $request->validated('name'),
        );
    }
}
