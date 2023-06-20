@props(['name', 'label', 'data', 'movie'])

<x-form.panel>
    <x-form.label name="{{ $name }}"> {{ $label }} </x-form.label>

    <img
        src="{{ asset('storage/' . $data) }}"
        alt="Imagen de {{ $movie }}"
        style="width: 30%"
        name="{{ $name }}"
        class="p-2 m-auto"
    >
</x-form.panel>

<x-form.error name="{{ $name }}" />
