<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seyteclub admin</title>

    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <!-- sweetalert + jquery cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->

    <!-- alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="{{ asset('/js/scripts.js') }}"></script>

</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand">SeyteClub Admins</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Home</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="{{ route('peliculas.index') }}">Películas</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="{{ route('generos.index') }}">Géneros</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                </li>

                <li class="nav-item">
                    <div>
                        <form action="/logout" method="POST" class="font-semibold text-red-500 ml-3 mt-2">
                        @csrf
                            <button type="submit">Cerrar sesión</button>
                        </form>
                    </div>
                @else
                    <a class="nav-link" href="/register">Regístrate</a>
                    <a class="nav-link" href="/login">Inicia sesión</a>
                </li>
                @endauth
            </ul>

            @auth
            <form class="d-flex" role="search" method="GET" action="{{ route('movies.search') }}">
            @csrf
                <input
                    class="form-control me-2"
                    type="search"
                    name="search"
                    id="search"
                    placeholder="Introduce un título"
                    aria-label="Search"
                    value="{{ request('search') }}"
                >
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
            @endauth

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            {{ $slot }}
        </div>
    </div>

    <footer></footer>

    <!-- Mensajes de feedback para el usuario -->
    <x-flash/>

</body>
</html>
