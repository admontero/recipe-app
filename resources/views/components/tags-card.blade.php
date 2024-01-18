<div class="card p-4 shadow-sm mb-4">
    <h4 class="mb-0">{{ __('front.components.tags-card.title') }}</h4>

    <hr>

    <div>
        @forelse ($tags as $tag)
            <a href="{{ route('recipes.tag.show', $tag) }}" class="text-success text-capitalize me-2">
                {{ $tag->name }}
            </a>
        @empty
            <p class="fst-italic text-muted small text-center">{{ __('front.components.tags-card.empty') }}</p>
        @endforelse
    </div>
</div>
