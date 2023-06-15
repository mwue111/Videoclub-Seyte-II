@props(['name', 'label', 'data' => null])

<x-form.panel>
    <x-form.label name="{{ $name }}">{{ $label }}</x-form.label>

    <input type="number" class="w-full" name="{{ $name }}" step="any" {{ $attributes(['value' => $data ? $data : old($name)])}}>
</x-form.panel>

<x-form.error name="{{ $name }}" />
