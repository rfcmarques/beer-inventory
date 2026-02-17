@props([
    'variant' => 'light',
])

@php
    $variantStyles = [
        'light' => [
            'table' => 'divide-neutral-200/70',
            'thead' => 'bg-neutral-50',
            'tbody' => 'divide-neutral-200/70 bg-white',
        ],
        'dark' => [
            'table' => 'divide-gray-700 text-gray-300',
            'thead' => 'bg-gray-800',
            'tbody' => 'divide-gray-700 bg-gray-900',
        ],
    ];
    $styles = $variantStyles[$variant] ?? $variantStyles['light'];
@endphp

{{-- ADD x-data HERE TO PROVIDE CONTEXT TO THE SLOT --}}
<div x-data="{ variant: '{{ $variant }}' }" class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="min-w-full align-middle">
            <div class="overflow-hidden rounded-md">
                <table class="min-w-full w-full {{ $styles['table'] }}">
                    <thead class="{{ $styles['thead'] }}">
                        {{ $header }}
                    </thead>
                    <tbody class="{{ $styles['tbody'] }}">
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
