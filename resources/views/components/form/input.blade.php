@props(['name'])

<x-form.field>
    <x-form.label name="{{ $name }}"/>
    <input id="{{ $name }}" name="{{ $name }}" {{ $attributes(['value' => old('name')]) }}
           class="border border-gray-200 p-2 w-full rounded">
    <x-error-message field="{{ $name }}"/>
</x-form.field>
