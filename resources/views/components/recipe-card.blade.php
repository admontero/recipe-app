@props(['showCategoryLabel' => true])

<div class="card h-100 shadow-sm">
    @if ($showCategoryLabel)
        <div class="position-relative">
            <a href="{{ route('recipes.show', $recipe) }}">
                <img class="bd-placeholder-img card-img-top" src="{{ $recipe->image_url }}" />
            </a>
            <div class="position-absolute" style="top: .5rem; left: .5rem;">
                <a href="{{ route('recipes.category.show', $recipe->category) }}">
                    <span class="badge bg-success fw-light">
                        {{ $recipe->category->name }}
                    </span>
                </a>
            </div>
        </div>
    @else
        <a href="{{ route('recipes.show', $recipe) }}">
            <img class="bd-placeholder-img card-img-top" src="{{ $recipe->image_url }}" />
        </a>
    @endif

    <div class="card-body">
        <div class="d-flex justify-content-between small mb-1">
            <p class="text-black-50">{{ $recipe->published_at->diffForHumans() }}</p>
            <p class="fw-bold bg-body-secondary px-2 rounded">
                <a class="text-black text-decoration-none" href="{{ route('recipes.user.show', $recipe->user) }}">
                    {{ $recipe->user->name }}
                </a>
            </p>
        </div>
        <h5 class="card-title">{{ $recipe->title }}</h5>
        <p class="card-text line-clamp-3 text-muted">{{ $recipe->excerpt }}</p>
    </div>
</div>
