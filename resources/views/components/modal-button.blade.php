@props(['target'])

{{-- @dd($attributes['class']) --}}

@php
    $defaults = [
        'type' => 'button',
        'class' => $attributes['class'],
        'data-bs-toggle' => 'modal',
        'data-bs-target' => $target,
    ];
@endphp

<button {{ $attributes($defaults) }}>
    {{ $slot }}
</button>
