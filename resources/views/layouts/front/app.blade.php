<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/7.1.0/css/flag-icons.min.css" integrity="sha512-bZBu2H0+FGFz/stDN/L0k8J0G8qVsAL0ht1qg5kTwtAheiXwiRKyCq1frwfbSFSJN3jooR5kauE0YjtPzhZtJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="bg-body-tertiary d-flex flex-column min-vh-100 ">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark shadow-sm bg-success" style="z-index: 1021;">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Recipe') }}
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            @auth
                                <li class="nav-item">
                                    <a href="{{ route('recipes.favorite.show') }}" class="nav-link">{{ __('front.navigation.favorites') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('recipes.index') }}" class="nav-link">{{ __('front.navigation.recipes') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('back.recipes.create') }}" class="nav-link">{{ __('front.navigation.new-recipe') }}</a>
                                </li>
                            @endauth
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown me-2">
                                <a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="fi fi-{{ config('languages')[App::getLocale()]['icon'] ?? '' }}"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                                    @foreach (config('languages') as $key => $language)
                                        @if ($key !== App::getLocale())
                                            <a class="dropdown-item" href="{{ route('language.switch', ['language' => $key ]) }}">
                                                <span class="fi fi-{{ $language['icon'] }} me-2"></span>
                                                {{ __($language['display']) }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </li>

                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('back.profile.edit') }}">
                                            {{ __('Profile') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('hero')

            <main class="container my-4">
                {{ $slot }}
            </main>
        </div>

        <footer class="mt-auto bg-success py-2">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="text-white text-decoration-none fs-4" href="{{ url('/') }}">
                    {{ config('app.name', 'Recipe') }}
                </a>
                <p class="text-white mb-0 fw-light">{{ now()->format('Y') }}</p>
            </div>
        </footer>

        @stack('scripts')
    </body>
</html>
