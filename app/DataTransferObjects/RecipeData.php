<?php

namespace App\DataTransferObjects;

use App\Http\Requests\RecipeRequest;

class RecipeData
{
    public function __construct(
        public readonly string $title,
        public readonly string $excerpt,
        public readonly string $description,
        public readonly string $ingredients,
        public readonly string $preparation,
        public readonly ?string $image,
        public readonly ?string $imageExtension,
        public readonly ?string $published_at,
        public readonly int $category_id,
        public readonly array $tags,
    ) {}

    public static function fromRequest(RecipeRequest $request): self
    {
        return new static(
            title: $request->validated('title'),
            excerpt: $request->validated('excerpt'),
            description: $request->validated('description'),
            ingredients: $request->validated('ingredients'),
            preparation: $request->validated('preparation'),
            image: $request->validated('image'),
            imageExtension: $request->file('image')?->getClientOriginalExtension(),
            published_at: $request->validated('published_at'),
            category_id: $request->validated('category_id'),
            tags: $request->validated('tags'),
        );
    }
}
