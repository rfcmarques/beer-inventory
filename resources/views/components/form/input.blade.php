@props(['label', 'name', 'class', 'type' => 'text', 'value' => old($name)])

@php
    $defaults = [
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'class' => 'form-control',
        'value' => $value,
    ];

    if ($type === 'number') {
        $defaults['step'] = 0.01;
    }

    if ($errors->has($name)) {
        $defaults['class'] .= ' is-invalid';
    }
@endphp

<x-form.field :$label :$name>
    <input {{ $attributes($defaults) }}>
</x-form.field>
