<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 font-weight-bold">
                {{ __('modules.recipe.index.header') }}
            </h2>
            <a href="{{ route('back.recipes.create') }}" class="btn btn-sm btn-success">{{ __('modules.recipe.create.title') }}</a>
        </div>
    </x-slot>

    <x-breadcrumbs>
        <li class="breadcrumb-item">{{ __('modules.recipe.index.header') }}</li>
    </x-breadcrumbs>

    <x-table-section>
        <x-slot name="title">
            {{ __('modules.recipe.index.title') }}
        </x-slot>

        <x-slot name="description">
            {{ __('modules.recipe.index.description') }}
        </x-slot>

        <x-slot name="alert">
            @if (session('status'))
                <x-alert-action />
            @endif
        </x-slot>

        <div class="table-responsive table-light">
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">{{ __('Title') }}</th>
                        <th scope="col">{{ __('Category') }}</th>
                        <th scope="col">{{ __('Published') }}</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recipes as $recipe)
                        <tr>
                            <td scope="row">
                                {{ $recipe->title }}
                            </td>
                            <td>{{ $recipe->category->name }}</td>
                            <td >
                                @if ($recipe->isPublished())
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"><path fill="#198754" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417L5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"><path fill="#dc3545" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/></svg>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group dropend">
                                    <x-button type="submit" id="dropdownButton" class="btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('Actions') }}
                                    </x-button>
                                    <ul class="dropdown-menu position-fixed">
                                        @if ($recipe->isPublished())
                                            <li>
                                                <a class="dropdown-item" href="{{ route('recipes.show', $recipe) }}">{{ __('Show') }}</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item" href="{{ route('back.recipes.edit', $recipe) }}">{{ __('Edit') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            {{ $recipes->links() }}
        </div>
    </x-table-section>
</x-app-layout>

