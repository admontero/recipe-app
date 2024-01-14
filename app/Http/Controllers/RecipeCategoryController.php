<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Category $category)
    {
        $recipes = Recipe::select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'category_id', 'user_id')
            ->with('tags:id,name,slug', 'user:id,name')
            ->where('category_id', $category->id)
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('recipes.category-show', [
            'category' => $category,
            'recipes' => $recipes,
        ]);
    }
}
