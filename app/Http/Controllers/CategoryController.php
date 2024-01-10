<?php

namespace App\Http\Controllers;

use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\RestoreCategoryAction;
use App\Actions\Category\UpsertCategoryAction;
use App\DataTransferObjects\CategoryData;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
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
        return view('categories.index', [
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
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, UpsertCategoryAction $upsertCategoryAction): RedirectResponse
    {
        $this->authorize('create', Category::class);

        $upsertCategoryAction->handle(CategoryData::fromRequest($request));

        return Redirect::route('categories.index')
            ->with('status', 'category.success.saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category, UpsertCategoryAction $upsertCategoryAction): RedirectResponse
    {
        $this->authorize('update', $category);

        $upsertCategoryAction->handle(CategoryData::fromRequest($request), $category);

        return Redirect::route('categories.index')
            ->with('status', 'category.success.saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, DeleteCategoryAction $deleteCategoryAction): RedirectResponse
    {
        $this->authorize('delete', $category);

        $deleteCategoryAction->handle($category);

        return Redirect::route('categories.index')
            ->with('status', 'category.success.deleted');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $id, RestoreCategoryAction $restoreCategoryAction): RedirectResponse
    {
        $this->authorize('restore', new Category());

        $restoreCategoryAction->handle($id);

        return Redirect::route('categories.index')
            ->with('status', 'category.success.restored');
    }
}
