@props(['name', 'label', 'data'])

<x-form.label name="{{ $name }}">{{ $label }}</x-form.label>

<input class="border border-gray-200 p-2 w-full rounded"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $data->title }}"
>
