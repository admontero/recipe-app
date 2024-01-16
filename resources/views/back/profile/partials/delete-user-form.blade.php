<x-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </x-slot>

    <x-slot name="content">
        <div>
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-3">
            <x-button data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                {{ __('Delete Account') }}
            </x-button>

            <!-- Modal -->
            <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">
                                {{ __('modules.profile.delete.title') }}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                {{ __('modules.profile.delete.description') }}
                            </div>
                            <form id="deleteAccountForm" method="post" action="{{ route('back.profile.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <div>
                                    <x-input type="password" class="form-control {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" />
                                    <x-input-error class="mt-2" for="password" keyForm="userDeletion" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger" form="deleteAccountForm">
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-action-section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ({{ count($errors->userDeletion) }}) {
                var myModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'), {
                    keyboard: false
                })

                var modalToggle = document.getElementById('deleteAccountModal')

                myModal.show(modalToggle);
            }
        });
    </script>
@endpush
