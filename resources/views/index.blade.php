<x-app-front-layout>
    @section('hero')
       <x-main-hero-card />
    @endsection

    <div class="album py-5">
        <div class="container">
            <x-recent-recipes-section />

            <x-popular-recipes-section />

            <x-categories-recipes-section />
        </div>
    </div>
</x-app-front-layout>
