<?php

namespace App\View\Components;

use App\Models\Recipe;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PopularRecipesSection extends Component
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
        $recipes = Recipe::select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'user_id', 'category_id')
            ->with('tags:id,name,slug', 'user:id,name', 'category:id,name,slug')
            ->withCount('favorites')
            ->has('category')
            ->has('favorites')
            ->published()
            ->orderBy('favorites_count', 'DESC')
            ->take(3)
            ->get();


        return view('components.popular-recipes-section', [
            'recipes' => $recipes,
        ]);
    }
}
