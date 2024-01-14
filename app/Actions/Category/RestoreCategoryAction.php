<?php

namespace App\Actions\Category;

use App\Models\Category;

class RestoreCategoryAction
{
    public function handle(string $slug): void
    {
        Category::where('slug', $slug)->withTrashed()->restore();
    }
}
