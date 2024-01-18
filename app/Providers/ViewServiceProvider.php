<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer(
            [
                'index',
            ],
            function (View $view) {
                $view->with(
                    'popularRecipes',
                    Recipe::select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'user_id', 'category_id')
                        ->with('tags:id,name,slug', 'user:id,name', 'category:id,name,slug')
                        ->withCount('favorites')
                        ->mostPopular()
                        ->get()
                );

                $view->with(
                    'recentRecipes',
                    Recipe::select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'user_id', 'category_id')
                        ->with('tags:id,name,slug', 'user:id,name', 'category:id,name,slug')
                        ->mostRecent()
                        ->get()
                );

                $view->with('categoriesWithRecipes', Category::select('id', 'name', 'slug')
                    ->withCount('recipes')
                    ->with(['recipes' => function($recipes) {
                        $recipes->select('id', 'title', 'slug', 'excerpt', 'image', 'published_at', 'category_id', 'user_id')
                            ->with('tags:id,name,slug', 'user:id,name')
                            ->has('category')
                            ->published()
                            ->latest('published_at')
                            ->limit(3);
                    }])
                    ->orderBy('recipes_count', 'DESC')
                    ->having('recipes_count', '>', 0)
                    ->take(3)
                    ->get());

                $view->with('categories', Category::select('id', 'name', 'slug')->get());
        });

        Facades\View::composer(
            [
                'recipes.index',
                'recipes.show',
                'recipes.category-show',
                'recipes.favorite-show',
                'recipes.search-show',
                'recipes.tag-show',
                'recipes.user-show',
            ],
            function (View $view) {
                $view->with(
                    'categoriesWithRecipesCount',
                    Category::with([
                        'recipes' => function ($recipes) {
                            $recipes->published();
                        }
                    ])
                        ->withCount(['recipes' => function ($query) {
                            $query->published();
                        }])
                        ->having('recipes_count', '>', 0)
                        ->orderBy('recipes_count', 'DESC')
                        ->take(5)
                        ->get()
                );
            }
        );
    }
}
