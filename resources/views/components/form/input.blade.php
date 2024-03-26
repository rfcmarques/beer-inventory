<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="text" class="form-control @error($name) is-invalid @enderror" {{ $attributes->except('label') }}>
</div>
