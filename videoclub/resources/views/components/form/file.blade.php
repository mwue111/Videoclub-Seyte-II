@props(['name', 'label'])

<x-form.panel>
    <x-form.label name="{{ $name }}">{{ $label }}</x-form.label>

    <input type="file" name="{{ $name }}">
</x-form.panel>

<x-form.error name="{{ $name }}" />
