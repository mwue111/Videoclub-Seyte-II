@forelse($genres as $genre){
<a href="">{{$genre -> name}}</a>
}
@empty
<p>No hay géneros disponibles</p>
@endforelse