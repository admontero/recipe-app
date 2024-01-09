@props(['for', 'keyForm' => null])

@error($for, $keyForm)
    <span {{ $attributes->merge(['class' => 'invalid-feedback d-block']) }} role="alert">
        {{ $message }}
    </span>
@enderror
