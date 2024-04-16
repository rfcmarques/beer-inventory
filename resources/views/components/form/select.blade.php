<div class="mb-3">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-select  @error($name) is-invalid @enderror">
        <option value="">Select your option</option>
        @foreach ($options as $option)
            {{-- this is actually horse shit --}}
            <option value="{{ $option->id }}" {{ $value == $option->id ? 'selected' : '' }}>
                {{ $option->name ?? "{$option->type} {$option->capacity} ml" }}
            </option>
        @endforeach
    </select>
</div>
