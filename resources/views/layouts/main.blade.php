<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('frozen-orb-svgrepo-com.svg') }}" type="image/png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="/js/maps.js" defer></script>
    <script src="/js/create-event.js" defer></script>
    <script src="/js/script.js"></script>
    <script src="/js/disableSubmit.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navs">
            <div class="container-fluid">
                <a href="/" class="navbar-brand">
                    <img src="/img/frozen-orb-svgrepo-com.svg" alt="Logo" width="40">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Events</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Create Events</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/contact" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Forum</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link">My events</a>
                            </li>

                            <!-- Foto de Perfil com Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(auth()->check() && auth()->user()->profile_picture)
                                        <img src="{{ asset('uploads/profile_pictures/' . auth()->user()->profile_picture) }}" alt="Foto de Perfil"
                                            class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('uploads/profile_pictures/picture_user.jpg') }}" alt="Foto de Perfil"
                                            class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                    @endif
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                    <li><a class="dropdown-item" href="/my-account">Meu Perfil</a></li>
                                    <li>
                                        <form action="/logout" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item"
                                                style="background: none; border: none;">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a href="/login" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link">Register</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                @if(session('msg'))
                    <p class="msg">{{session('msg')}}</p>
                @endif
                @yield('content')
            </div>
        </div>

    </main>

    <footer>
        <p>HDC &copy; 2024</p>
    </footer>
</body>

</html>