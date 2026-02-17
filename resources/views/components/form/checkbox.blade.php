@props([
    'name',
    'id' => null,
    'label' => '',
    'value' => 1,
    'checked' => false,
    'variant' => 'light',
])

@php
    $id = $id ?? str_replace(['[]', '[', ']'], '', $name) . '_' . $value;

    // --- THIS IS THE FIX ---
    // This new logic handles both single checkboxes and checkbox groups.
    $isChecked = false;
    if (old($name)) {
        $isChecked = is_array(old($name))
            ? in_array($value, old($name))
            : old($name) == $value;
    } else {
        $isChecked = $checked;
    }

    $variantStyles = [
        'light' => [
            'label' => 'text-neutral-600 peer-checked:text-blue-600 peer-checked:[&_.custom-checkbox]:border-blue-500 peer-checked:[&_.custom-checkbox]:bg-blue-500',
            'box' => 'border-gray-300',
        ],
        'dark' => [
            'label' => 'text-gray-300 peer-checked:text-blue-400 peer-checked:[&_.custom-checkbox]:border-blue-400 peer-checked:[&_.custom-checkbox]:bg-blue-400',
            'box' => 'border-gray-600',
        ],
    ];
    $styles = $variantStyles[$variant] ?? $variantStyles['light'];
@endphp

<div class="flex items-center">
    <input
        name="{{ $name }}"
        id="{{ $id }}"
        type="checkbox"
        value="{{ $value }}"
        class="hidden peer"
        @if ($isChecked) checked @endif
        {{ $attributes }}
    >
    <label
        for="{{ $id }}"
        class="flex cursor-pointer select-none items-center space-x-2 text-sm font-medium [&_svg]:scale-0 peer-checked:[&_svg]:scale-100 {{ $styles['label'] }}"
    >
        <span class="custom-checkbox flex h-5 w-5 items-center justify-center rounded border-2 text-neutral-900 {{ $styles['box'] }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="h-3 w-3 text-white duration-300 ease-out">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </span>
        <span>{{ $label ?? $slot }}</span>
    </label>
</div>