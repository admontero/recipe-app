<x-app-front-layout>
    @section('hero')
       <x-main-hero-card :$categories />
    @endsection

    <div class="album py-3">
        <div class="container">
            <x-recent-recipes-section :recipes="$recentRecipes" />

            <x-popular-recipes-section :recipes="$popularRecipes" />

            <x-categories-recipes-section :categories="$categoriesWithRecipes" />
        </div>
    </div>
</x-app-front-layout>
