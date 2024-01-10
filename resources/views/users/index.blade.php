<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 font-weight-bold">
                {{ __('user.index.header') }}
            </h2>
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">{{ __('user.create.title') }}</a>
        </div>
    </x-slot>

    <x-breadcrumbs>
        <li class="breadcrumb-item">{{ __('user.index.header') }}</li>
    </x-breadcrumbs>

    <x-table-section>
        <x-slot name="title">
            {{ __('user.index.title') }}
        </x-slot>

        <x-slot name="description">
            {{ __('user.index.description') }}
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
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Role') }}</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td scope="row">
                                {{ $user->name }}
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->isAdmin())
                                    <span class="badge bg-warning text-black">Admin</span>
                                @else
                                    <span class="badge bg-light text-dark">User</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group dropend">
                                    <x-button type="submit" id="dropdownButton" class="btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('Actions') }}
                                    </x-button>
                                    <ul class="dropdown-menu position-fixed">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('users.edit', $user) }}">{{ __('Edit') }}</a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}">
                                                {{ __('Delete') }}
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUser{{ $user->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    {{ __('user.delete.description') }}
                                                    <span class="fw-bold">{{ $user->email }}</span>.
                                                </div>
                                                <form id="deleteUser{{ $user->id }}Form" method="post" action="{{ route('users.destroy', $user) }}" class="p-6">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('Cancel') }}
                                                </button>
                                                <button type="submit" class="btn btn-danger" form="deleteUser{{ $user->id }}Form">
                                                    {{ __('user.delete.action') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Modal -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            {{ $users->links() }}
        </div>
    </x-table-section>
</x-app-layout>

