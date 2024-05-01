<select id="{{ $name }}" name="{{ $name }}" class="form-select  @error($name) is-invalid @enderror">
    <option value="">Select your option</option>
    {{ $slot }}
</select>
