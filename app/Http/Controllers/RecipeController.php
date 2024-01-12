<?php

namespace App\Http\Controllers;

use App\Actions\Recipe\UpsertRecipeAction;
use App\DataTransferObjects\RecipeData;
use App\Http\Requests\RecipeRequest;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('recipes.index', [
            'recipes' => Recipe::select('id', 'title', 'slug', 'category_id', 'published_at')
                ->with('category:id,name')
                ->when(! auth()->user()->isAdmin(), fn ($query) => $query->where('user_id', auth()->id()))
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('recipes.create', [
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeRequest $request, UpsertRecipeAction $upsertRecipeAction): RedirectResponse
    {
        $this->authorize('create', Recipe::class);

        $upsertRecipeAction->handle(RecipeData::fromRequest($request));

        return Redirect::route('recipes.index')
            ->with('status', 'recipe.success.saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe): View
    {
        return view('recipes.index', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe): View
    {
        $recipe->load('tags:id,name');

        return view('recipes.edit', [
            'recipe' => $recipe,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecipeRequest $request, Recipe $recipe, UpsertRecipeAction $upsertRecipeAction): RedirectResponse
    {
        $this->authorize('update', $recipe);

        $upsertRecipeAction->handle(RecipeData::fromRequest($request), $recipe);

        return Redirect::route('recipes.index')
            ->with('status', 'recipe.success.saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
