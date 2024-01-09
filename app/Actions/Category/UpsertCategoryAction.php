<?php

namespace App\Actions\Category;

use App\DataTransferObjects\CategoryData;
use App\Models\Category;

class UpsertCategoryAction
{
    public function handle(CategoryData $data, Category $category = null): void
    {
        Category::updateOrCreate(
            [
                'id' => $category?->id,
            ],
            [
                'name' => $data->name,
            ]
        );
    }
}
