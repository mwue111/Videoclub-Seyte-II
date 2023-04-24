<x-layout>
    @if($movies)
    <ul>
        @foreach($movies as $movie)
            <li>{{$movie->title}}
                <a href="{{ route('movies.restore') }}"></a>
            </li>
        @endforeach
    </ul>
    @endif
</x-layout>
