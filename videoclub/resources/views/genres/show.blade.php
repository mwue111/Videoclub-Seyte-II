<p>{{$genre->name}}</p>
<a href="{{ route('generos.index') }}">Volver</a>
<form action="{{route('generos.destroy', $genre->id) }}" method="POST">
  @csrf
  @method('DELETE')
  <input type="submit" value="Eliminar">
</form>