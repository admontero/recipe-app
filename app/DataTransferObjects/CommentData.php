<?php

namespace App\DataTransferObjects;

use App\Http\Requests\CommentRequest;

class CommentData
{
    public function __construct(
        public readonly string $body,
    ) {}

    public static function fromRequest(CommentRequest $request): self
    {
        return new static(
            body: $request->validated('body'),
        );
    }
}
