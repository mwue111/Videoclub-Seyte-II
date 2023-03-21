<h1>Editar género</h1>

<form action="{{ route('generos.update', $genre) }}" method="POST">
  @csrf
  @method('PUT')

  <label for="name">Nombre de la categoría</label>
  <br>
  <input type="text" name="name" value="{{ $genre->name }}" />

  <input type="submit" value="Guardar">

</form>

<a href="{{ route('generos.index') }}">Volver</a>