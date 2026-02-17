@props([
    'sortable' => null,
    'direction' => null,
    'noIcon' => false,
])

<th
    {{ $attributes->merge(['class' => 'px-5 py-3 text-left' . ($sortable ? ' cursor-pointer' : '')]) }}
>
    <div class="flex flex-row items-center justify-between gap-1">
        <span>{{ $slot }}</span>

        @if (!$noIcon)
            @switch($sortable)
                @case($direction === 'asc')
                    <x-icons.chevron-up class="w-4 h-4" />
                    @break
                @case($direction === 'desc')
                    <x-icons.chevron-down class="w-4 h-4" />
                @break
            @default
                <x-icons.chevron-up-down class="w-4 h-4 text-neutral-400" />
                @break
            @endswitch
        @endif
    </div>
</th>
