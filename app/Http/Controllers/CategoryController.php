<?php

namespace App\Http\Controllers;

use App\Actions\Category\UpsertCategoryAction;
use App\DataTransferObjects\CategoryData;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
    public function store(CategoryRequest $request, UpsertCategoryAction $upsertCategoryAction)
    {
        $upsertCategoryAction->handle(CategoryData::fromRequest($request));

        return redirect()
            ->route('categories.index')
            ->with('status', 'saved');
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
    public function update(CategoryRequest $request, Category $category, UpsertCategoryAction $upsertCategoryAction): RedirectResponse | Redirector
    {
        $upsertCategoryAction->handle(CategoryData::fromRequest($request), $category);

        return redirect()
            ->route('categories.index')
            ->with('status', 'saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse | Redirector
    {
        abort_if(! auth()->user()?->isAdmin(), 403);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('status', 'deleted');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $id): RedirectResponse | Redirector
    {
        abort_if(! auth()->user()?->isAdmin(), 403);

        Category::where('id', $id)->withTrashed()->restore();

        return redirect()
            ->route('categories.index')
            ->with('status', 'restored');
    }
}
