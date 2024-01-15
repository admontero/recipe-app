<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Tag;
use Illuminate\Http\Request;

class RecipeTagController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Tag $tag)
    {
        $recipes = Recipe::select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'category_id', 'user_id')
            ->with('tags:id,name,slug', 'user:id,name')
            ->has('category')
            ->whereHas('tags', fn ($query) => $query->where('tag_id', $tag->id))
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('recipes.tag-show', [
            'tag' => $tag,
            'recipes' => $recipes,
        ]);
    }
}
