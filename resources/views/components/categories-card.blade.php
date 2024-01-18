<div class="card p-4 shadow-sm">
    <h4 class="mb-0">{{ __('front.components.categories-card.title') }}</h4>

    <hr>

    @forelse ($categories as $category)
        <p>
            <a href="{{ route('recipes.category.show', $category) }}" class="text-success">
                {{ $category->name }} ({{ $category->recipes_count }})
            </a>
        </p>
    @empty
        <p class="fst-italic text-muted small text-center">{{ __('front.components.categories-card.empty') }}</p>
    @endforelse
</div>
