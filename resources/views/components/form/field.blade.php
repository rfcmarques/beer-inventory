@props([
    'label',
    'name',
    'error',
])
<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    @if ($label)
        <x-form.label :for="$name" :label="$label" />
    @endif

    {{ $slot }}

    <x-form.error :for="$error" />
</div>