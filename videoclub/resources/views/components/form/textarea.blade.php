@props(['name', 'label', 'data'])

<x-form.label name="{{ $name }}">{{ $label }}</x-form.label>

<textarea class="border border-gray-200 p-2 w-full rounded"
        type="text"
        name="{{ $name }}"
        id="{{ $name }}"
>
    {{ $data }}
</textarea>

<x-form.error name="{{ $name }}" />
