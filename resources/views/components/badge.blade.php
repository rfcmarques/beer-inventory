@props([
    'color' => 'primary',
])

@php
    $classes = \App\Enums\Styling::badge($color);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
