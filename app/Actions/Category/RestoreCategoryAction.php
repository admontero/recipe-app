<?php

namespace App\Actions\Category;

use App\Models\Category;

class RestoreCategoryAction
{
    public function handle(int $id): void
    {
        Category::where('id', $id)->withTrashed()->restore();
    }
}
