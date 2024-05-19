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
        <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
        <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
        <script src="/js/script.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="" class="navbar-brand">
                        <img src="/img/evento.png">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Events</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Create Events</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Enter</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/register" class="nav-link">Register</a>
                        </li>
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
