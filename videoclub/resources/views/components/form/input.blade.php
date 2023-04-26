@props(['name', 'label', 'data' => null])
<x-form.panel>
    <x-form.label name="{{ $name }}">{{ $label }}</x-form.label>

    <input  {{ $attributes(['class' => 'border border-gray-200 p-2 w-full rounded']) }}
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes(['value' => $data ? $data : old($name)])}}
    >
</x-form.panel>
<x-form.error name="{{ $name }}" />

