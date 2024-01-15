<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeFavoriteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $recipes = auth()->user()
            ->favorites()
            ->has('category')
            ->published()
            ->paginate(10);

        return view('recipes.favorite-show', [
            'recipes' => $recipes,
        ]);
    }
}
