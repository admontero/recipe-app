<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 font-weight-bold">
                {{ __('category.index.header') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success">{{ __('category.create.title') }}</a>
        </div>
    </x-slot>

    <x-breadcrumbs>
        <li class="breadcrumb-item">{{ __('category.index.header') }}</li>
    </x-breadcrumbs>

    <x-table-section>
        <x-slot name="title">
            {{ __('category.index.title') }}
        </x-slot>

        <x-slot name="description">
            {{ __('category.index.description') }}
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
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Slug') }}</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td scope="row">
                                @if ($category->trashed())
                                    <span class="fst-italic text-muted">
                                        {{ $category->name }}
                                        <small>({{ __('Deleted') }})</small>
                                    </span>
                                @else
                                    {{ $category->name }}
                                @endif
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td class="">
                                <div class="btn-group dropend">
                                    <x-button type="submit" id="dropdownButton" class="btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('Actions') }}
                                    </x-button>
                                    <ul class="dropdown-menu position-fixed">
                                        @if (! $category->trashed())
                                            <li>
                                                <a class="dropdown-item" href="{{ route('categories.edit', $category) }}">{{ __('Edit') }}</a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCategory{{ $category->id }}">
                                                    {{ __('Delete') }}
                                                </button>
                                            </li>

                                        @else
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#restoreCategory{{ $category->id }}">
                                                {{ __('Restore') }}
                                            </button>
                                        @endif
                                    </ul>
                                </div>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1" aria-labelledby="deleteCategory{{ $category->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    {{ __('category.delete.description') }}
                                                    <span class="fw-bold">{{ $category->name }}</span>.
                                                </div>
                                                <form id="deleteCategory{{ $category->id }}Form" method="post" action="{{ route('categories.destroy', $category) }}" class="p-6">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('Cancel') }}
                                                </button>
                                                <button type="submit" class="btn btn-danger" form="deleteCategory{{ $category->id }}Form">
                                                    {{ __('category.delete.action') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Modal -->

                                <!-- Restore Modal -->
                                <div class="modal fade" id="restoreCategory{{ $category->id }}" tabindex="-1" aria-labelledby="restoreCategory{{ $category->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    {{ __('category.restore.description') }}
                                                    <span class="fw-bold">{{ $category->name }}</span>.
                                                </div>
                                                <form id="restoreCategory{{ $category->id }}Form" method="post" action="{{ route('categories.restore', $category) }}" class="p-6">
                                                    @csrf
                                                    @method('post')
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('Cancel') }}
                                                </button>
                                                <button type="submit" class="btn btn-success" form="restoreCategory{{ $category->id }}Form">
                                                    {{ __('category.restore.action') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Restore Modal -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            {{ $categories->links() }}
        </div>
    </x-table-section>
</x-app-layout>
