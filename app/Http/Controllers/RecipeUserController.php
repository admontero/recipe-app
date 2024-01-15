<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;

class RecipeUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $recipes = Recipe::select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'category_id', 'user_id')
            ->with('tags:id,name,slug', 'user:id,name', 'category:id,name,slug')
            ->has('category')
            ->where('user_id', $user->id)
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('recipes.user-show', [
            'user' => $user,
            'recipes' => $recipes,
        ]);
    }
}
