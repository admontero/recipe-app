@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'fw-bold fs-6 text-success']) }}>
        {{ $status }}
    </div>
@endif
