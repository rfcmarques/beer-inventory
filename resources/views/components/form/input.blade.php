@props(['type' => 'text', 'name', 'value'])

<input type="{{ $type ?? 'text' }}" id="{{ $name }}" name="{{ $name }}"
    class="form-control @error($name) is-invalid @enderror" value="{{ $value }}" />
