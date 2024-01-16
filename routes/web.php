<?php

use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\ProfileController;
use App\Http\Controllers\Back\RecipeController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RecipeCategoryController;
use App\Http\Controllers\RecipeController as RecipeFrontController;
use App\Http\Controllers\RecipeFavoriteController;
use App\Http\Controllers\RecipeSearchController;
use App\Http\Controllers\RecipeTagController;
use App\Http\Controllers\RecipeUserController;
use App\Http\Controllers\SwitchLanguageController;
use App\Http\Controllers\ToggleFavoriteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('back.')->prefix('back')->middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/dashboard', function () { return view('back.dashboard'); });

    Route::resource('categories', CategoryController::class)->except('show');

    Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');

    Route::resource('users', UserController::class);
});

Route::name('back.')->prefix('back')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::resource('recipes', RecipeController::class)->except('show');
});


Route::get('/', PageController::class);

Route::get('recipes/search', RecipeSearchController::class)->name('recipes.search');

Route::middleware('auth')->group(function () {
    Route::get('recipes', [RecipeFrontController::class, 'index'])->name('recipes.index');

    Route::get('recipes/favorites', RecipeFavoriteController::class)->name('recipes.favorite.show');
});

Route::get('recipes/{recipe}', [RecipeFrontController::class, 'show'])->name('recipes.show');

Route::get('categories/{category}/recipes', RecipeCategoryController::class)->name('recipes.category.show');

Route::get('tags/{tag}/recipes', RecipeTagController::class)->name('recipes.tag.show');

Route::get('users/{user}/recipes', RecipeUserController::class)->name('recipes.user.show');

Route::get('language/switch', SwitchLanguageController::class)->name('language.switch');

Route::middleware('auth')->group(function () {
    Route::post('recipes/{recipe}/favorite', ToggleFavoriteController::class)->name('recipes.favorite');
});

require __DIR__.'/auth.php';

Route::fallback(function () { return abort(404); });
