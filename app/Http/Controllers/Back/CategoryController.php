<?php

namespace App\Http\Controllers\Back;

use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\RestoreCategoryAction;
use App\Actions\Category\UpsertCategoryAction;
use App\DataTransferObjects\CategoryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('back.categories.index', [
            'categories' => Category::select('id', 'name', 'slug', 'deleted_at')
                ->withTrashed()
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('back.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, UpsertCategoryAction $upsertCategoryAction): RedirectResponse
    {
        $this->authorize('create', Category::class);

        $upsertCategoryAction->handle(CategoryData::fromRequest($request));

        return Redirect::route('back.categories.index')
            ->with('status', 'modules.category.success.saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('back.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category, UpsertCategoryAction $upsertCategoryAction): RedirectResponse
    {
        $this->authorize('update', $category);

        $upsertCategoryAction->handle(CategoryData::fromRequest($request), $category);

        return Redirect::route('back.categories.index')
            ->with('status', 'modules.category.success.saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, DeleteCategoryAction $deleteCategoryAction): RedirectResponse
    {
        $this->authorize('delete', $category);

        $deleteCategoryAction->handle($category);

        return Redirect::route('back.categories.index')
            ->with('status', 'modules.category.success.deleted');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $slug, RestoreCategoryAction $restoreCategoryAction): RedirectResponse
    {
        $this->authorize('restore', new Category());

        $restoreCategoryAction->handle($slug);

        return Redirect::route('back.categories.index')
            ->with('status', 'modules.category.success.restored');
    }
}
