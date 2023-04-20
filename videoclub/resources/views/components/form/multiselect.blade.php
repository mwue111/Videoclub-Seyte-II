@props(['name', 'label', 'data'])

<x-form.panel>
    <x-form.label name="{{ $name }}">{{ $label }}</x-form>

    <div class="btn-group p-2" role="group" aria-label="Basic checkbox toggle button group">
        @foreach($data as $genre)
            <input type="checkbox" class="btn-check"  name="{{ $name }}" id="{{ $genre->id }}" autocomplete="off" value="{{ $genre->id }}">
            <label class="btn btn-outline-secondary" for="{{ $genre->id }}">{{ $genre->name }}</label>
        @endforeach

    </div>
</x-form>
