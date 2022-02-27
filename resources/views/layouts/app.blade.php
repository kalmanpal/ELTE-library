<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('frontend/css/bootstrap5.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/home">
                    ELTE könyvtár
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Bejelentkezés') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Regisztráció') }}</a>
                                </li>
                            @endif
                        @else


                            @if (Auth::user()->type == 'E')

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Könyvek
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/books">
                                            Összes könyv
                                        </a>

                                        <a class="dropdown-item" href="/newbook">
                                            Új könyv felvétel
                                        </a>

                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Kölcsönzések
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/rentals">
                                            Aktív kölcsönzések
                                        </a>

                                        <a class="dropdown-item" href="">
                                            Régebbi kölcsönzések
                                        </a>

                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/reservations">Foglalások</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Tagok
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/users">
                                            Összes felhasználó
                                        </a>

                                        <a class="dropdown-item" href="">
                                            Új felhasználó
                                        </a>

                                    </div>
                                </li>

                            @else

                                <li class="nav-item">
                                    <a class="nav-link" href="/books-available"> Könyvek</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/myreservations">Foglalásaim</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/myrentals">Kölcsönzés előzményeim</a>
                                </li>

                            @endif



                            <li class="nav-item">
                                <a class="nav-link disabled">{{Auth::user()->name}}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @if (!(Auth::user()->type == 'E'))

                                        <a class="dropdown-item" href="">
                                            Előfizetések
                                        </a>

                                        <a class="dropdown-item" href="/badges">
                                            Jelvények
                                        </a>

                                    @endif

                                    <a class="dropdown-item" href="/profile">
                                        Profil
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Kijelentkezés') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" defer></script>
</body>
</html>
