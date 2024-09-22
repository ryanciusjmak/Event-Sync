<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('frozen-orb-svgrepo-com.svg') }}" type="image/png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <div id="loading" class="loading-overlay">
        <div class="spinner"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="/js/maps.js" defer></script>
    <script src="/js/create-event.js" defer></script>
    <script src="/js/script.js"></script>
    <script src="/js/disableSubmit.js"></script>
    <script>
        $(document).ready(function() {
            $(window).on('load', function() {
                $('#loading').fadeOut();
            });

            $('form').on('submit', function() {
                $('#loading').fadeIn();
            });
        });
    </script>
    <header>
        <nav class="navbar-expand-lg">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="" class="navbar-brand">
                    <img src="/img/frozen-orb-svgrepo-com.svg">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Events</a>
                    </li>
                    <li class="nav-item">
                        <a href="/events/create" class="nav-link">Create Events</a>
                    </li>
                    <li class="nav-item">
                        <a href="/events/contact" class="nav-link">Contact</a>
                    </li>
                    <!-- Link para o Fórum -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">Forum</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">My events</a>
                    </li>
                    <li class="nav-item">
                        <form action="/logout" method="post">
                            @csrf
                            <a href="/logout" class="nav-link" onclick="event.preventDefault();
                                this.closest('form').submit();">Logout</a>
                        </form>
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
