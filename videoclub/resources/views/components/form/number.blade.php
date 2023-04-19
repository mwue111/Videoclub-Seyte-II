@props(['name', 'label', 'data'])

<x-form.label name="{{ $name }}">{{ $label }}</x-form.label>

<input type="number" name="{{ $name }}" value="{{ $data }}">
