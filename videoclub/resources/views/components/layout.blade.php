<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seyteclub admin</title>
    <script src="{{ asset('/js/scripts.js') }}"></script>
</head>
<body>

<!-- https://laracasts.com/series/laravel-8-from-scratch/episodes/31 -->

    <nav>
        <ul>
            <li>
                <a href="{{ route('peliculas.index') }}">Películas</a>
            </li>
            <li>
                <a href="{{ route('generos.index') }}">
                    Géneros
                </a>
            </li>
        </ul>
    </nav>

    {{ $slot }}

    <footer></footer>
</body>
</html>
