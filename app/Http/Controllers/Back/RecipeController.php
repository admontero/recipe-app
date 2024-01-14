<?php

namespace App\Http\Controllers\Back;

use App\Actions\Recipe\UpsertRecipeAction;
use App\DataTransferObjects\RecipeData;
use App\Http\Controllers\Controller;
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
        return view('back.recipes.index', [
            'recipes' => Recipe::select('id', 'title', 'slug', 'category_id', 'published_at')
                ->with('category:id,name')
                ->has('category')
                ->when(! auth()->user()->isAdmin(), fn ($query) => $query->where('user_id', auth()->id()))
                ->latest('published_at')
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('back.recipes.create', [
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

        return Redirect::route('back.recipes.index')
            ->with('status', 'modules.recipe.success.saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe): View
    {
        $recipe->load('tags:id,name');

        return view('back.recipes.edit', [
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

        return Redirect::route('back.recipes.index')
            ->with('status', 'modules.recipe.success.saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
