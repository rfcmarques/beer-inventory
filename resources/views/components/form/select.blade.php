@props(['label', 'name', 'class'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'form-select',
    ];

    if ($errors->has($name)) {
        $defaults['class'] .= ' is-invalid';
    }
@endphp

<x-form.field :$label :$name>
    <select {{ $attributes($defaults) }}>
        <option value="">Select your option</option>
        {{ $slot }}
    </select>
</x-form.field>
