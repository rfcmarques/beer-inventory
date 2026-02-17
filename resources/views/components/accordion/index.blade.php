@props([
    'defaultOpen' => '',
    'variant' => 'light',
    'multiple' => false, // New: Controls the behavior
])

@php
    // Allows passing a comma-separated string for multiple default open items
    $defaultOpen = $multiple && $defaultOpen
        ? json_encode(explode(',', $defaultOpen))
        : json_encode([$defaultOpen]);
@endphp

<div
    x-data="{
        activeAccordion: {{ $defaultOpen }},
        multiple: {{ $multiple ? 'true' : 'false' }},
        setActiveAccordion(id) {
            const index = this.activeAccordion.indexOf(id);

            if (index > -1) {
                this.activeAccordion.splice(index, 1);
                return;
            }

            if (this.multiple) {
                this.activeAccordion.push(id);
                return;
            }

            this.activeAccordion = [id];
        }
    }"
    {{-- The rest of the component remains the same --}}
    @php
        $baseClasses = 'relative w-full mx-auto overflow-hidden rounded-md border divide-y';
        $variantClasses = [
            'light'       => 'bg-white border-gray-200 divide-gray-200 text-gray-800',
            'dark'        => 'bg-gray-800 border-gray-700 divide-gray-700 text-white',
            'transparent' => 'bg-transparent border-transparent divide-transparent text-gray-800 dark:text-white',
        ][$variant] ?? 'bg-white border-gray-200 divide-gray-200 text-gray-800';
    @endphp
    class="{{ $baseClasses . ' ' . $variantClasses }}"
>
    {{ $slot }}
</div>