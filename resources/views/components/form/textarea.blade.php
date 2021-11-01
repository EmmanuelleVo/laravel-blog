@props(['name'])

<x-form.field>
    <x-form.label name="{{ $name }}"/>
    <textarea id="{{ $name }}" name="{{ $name }}" required
              class="border border-gray-200 p-2 w-full rounded">
        {{ $slot ?? old($name) }}
    </textarea>
    <x-error-message field="{{ $name }}"/>
</x-form.field>
