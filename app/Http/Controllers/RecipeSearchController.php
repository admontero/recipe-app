<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeSearchRequest;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeSearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RecipeSearchRequest $request): View
    {
        $recipes = Recipe::select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'user_id', 'category_id')
            ->with('tags:id,name,slug', 'user:id,name', 'category:id,name,slug')
            ->has('category')
            ->where('title', 'like', '%' . $request->validated('title') . '%')
            ->when($request->validated('slug'), fn ($query) => $query->whereRelation('category', 'slug', $request->validated('slug')))
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('recipes.search-show', [
            'recipes' => $recipes,
        ]);
    }
}
