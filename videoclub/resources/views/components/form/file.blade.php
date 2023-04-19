@props(['name', 'label'])

<x-form.label name="{{ $name }}">{{ $label }}</x-form.label>

<input type="file" name="{{ $name }}">
