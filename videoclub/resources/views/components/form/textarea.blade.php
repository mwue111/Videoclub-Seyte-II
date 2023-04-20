@props(['name', 'label', 'data' => null])

<x-form.panel>
    <x-form.label name="{{ $name }}">{{ $label }}</x-form.label>

    <textarea class="border border-gray-200 p-2 w-full h-32 rounded"
            type="text"
            name="{{ $name }}"
            id="{{ $name }}"
    >
        {{ $data ? $data : null }}
    </textarea>
</x-form.panel>
<x-form.error name="{{ $name }}" />
