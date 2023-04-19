<x-layout>
    <form action="{{ route('generos.store') }}" method="POST">
      @csrf
      <label for="name">Nombre del género</label>
      <br>
      <input type="text" name="name" />
      <br>
      <input type="submit" value="Añadir">
    </form>
    <a href="{{ route('generos.index') }}">Volver</a>
</x-layout>
