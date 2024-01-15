<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Recipe $recipe)
    {
        $recipes = Recipe::select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'category_id', 'user_id')
            ->with('user:id,name', 'category:id,name,slug')
            ->has('category')
            ->where('user_id', auth()->id())
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('recipes.index', [
            'recipes' => $recipes,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe->loadCount('favorites');

        return view('recipes.show', compact('recipe'));
    }
}
