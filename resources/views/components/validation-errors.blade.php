@if ($errors->any())
    <div {!! $attributes->merge(['class' => 'alert alert-danger text-sm p-2 rounded-2']) !!} role="alert">
        <div class="font-weight-bold">{{ __('Whoops! Something went wrong.') }}</div>

        <ol>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
@endif
