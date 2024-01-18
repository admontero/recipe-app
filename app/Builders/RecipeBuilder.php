<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class RecipeBuilder extends Builder
{
    public function published(): self
    {
        return $this->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function unpublished(): self
    {
        return $this->whereNull('published_at')
            ->orWhere('published_at', '>', now());
    }

    public function mostRecent(int $count = 3): self
    {
        return $this->has('category')
            ->published()
            ->latest('published_at')
            ->take($count);
    }

    public function mostPopular(int $count = 3): self
    {
        return $this->has('category')
            ->has('favorites')
            ->published()
            ->orderBy('favorites_count', 'DESC')
            ->take($count);
    }
}
