@props(['alert' => null])

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
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

