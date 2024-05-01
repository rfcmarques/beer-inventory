@props(['value', 'text', 'selectedValue'])

<option value="{{ $value }}" {{ $value === $selectedValue ? 'selected' : '' }}>{{ $text }}</option>
