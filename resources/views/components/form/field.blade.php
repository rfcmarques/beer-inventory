@props(['label', 'name'])

<div>
    @if ($label)
        <x-form.label :$name :$label />
    @endif

    {{ $slot }}

    <x-form.error :error="$errors->first($name)" />
</div>
