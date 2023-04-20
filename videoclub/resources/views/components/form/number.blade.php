@props(['name', 'label', 'data' => null])

<x-form.panel>
    <x-form.label name="{{ $name }}">{{ $label }}</x-form.label>

    <input type="number" class="w-full" name="{{ $name }}" value="{{ $data ? $data : null}}">
</x-form.panel>

<x-form.error name="{{ $name }}" />
