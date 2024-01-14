<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoriesRecipesSection extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::select('id', 'name', 'slug')
            ->withCount('recipes')
            ->with(['recipes' => function($recipes) {
                $recipes->select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'category_id', 'user_id')
                    ->with('tags:id,name,slug', 'user:id,name')
                    ->has('category')
                    ->published()
                    ->latest('published_at')
                    ->limit(3);
            }])
            ->orderBy('recipes_count', 'DESC')
            ->having('recipes_count', '>', 0)
            ->take(3)
            ->get();

        return view('components.categories-recipes-section', [
            'categories' => $categories,
        ]);
    }
}
