@props([
    'id',
    'name' => null,
    'type' => 'text',
    'value' => null,
])

@php
    $name ??= $id;
@endphp


<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-gray-900 border px-3 py-2']) }}>