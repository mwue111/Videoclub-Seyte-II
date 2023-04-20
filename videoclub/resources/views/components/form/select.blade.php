@props(['name', 'label', 'data'])

<x-form.panel>
    <x-form.label name="{{ $name }}">{{ $label }}</x-form>
    <select name="{{ $name }}" id="{{ $name }}">
        @foreach($data as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select>
</x-form.panel>
