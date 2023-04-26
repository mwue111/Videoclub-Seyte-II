@props(['name', 'label', 'data'])

<x-form.panel>
    <x-form.label name="{{ $name }}"> {{ $label }} </x-form.label>

    <video src="{{ asset('storage/' . $data) }}"
        style="width: 30%"
        name="{{ $name }}"
        class="p-2 m-auto"
        width="640"
        height="480"
        controls
    ></video>
</x-form.panel>

<x-form.error name="{{ $name }}" />
