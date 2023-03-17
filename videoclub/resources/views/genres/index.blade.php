@forelse($genres as $genre){
<a href="">{{$genre -> name}}</a>
}
@empty
<p>No genres</p>
@endforelse