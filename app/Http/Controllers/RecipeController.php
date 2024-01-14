<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }
}
