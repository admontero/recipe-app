@props(['method', 'action', 'alert' => null])

<div {{ $attributes->merge(['class' => 'row']) }}>
    <div class="col-md-4">
        <x-section-title>
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">
                <span class="small">
                    {{ $description }}
                </span>
            </x-slot>
        </x-section-title>
    </div>
    <div class="col-md-8">
        {{ $alert }}
        <div class="card shadow-sm">
            <form method="{{ $method }}" action="{{ $action }}">
                <div class="card-body row g-3 px-md-4 py-4">
                    {{ $form }}
                </div>

                @if (isset($actions))
                    <div class="card-footer d-flex justify-content-end">
                        {{ $actions }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
