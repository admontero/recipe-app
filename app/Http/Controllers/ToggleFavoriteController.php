<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ToggleFavoriteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Recipe $recipe): JsonResponse
    {
        $recipe->favorites()->toggle([auth()->id()]);

        return response()->json([
            'isFavorite' => $recipe->isFavorite(auth()->id()),
            'count' => $recipe->favorites->count()
        ]);
    }
}
