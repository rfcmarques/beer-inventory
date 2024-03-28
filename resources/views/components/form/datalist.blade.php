<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" id="{{ $name }}" name="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror" value="{{ $value }}" list="options" />
    <datalist id="options">
        @foreach ($options as $option)
            <option value="{{ $option }}"></option>
        @endforeach
    </datalist>
</div>
