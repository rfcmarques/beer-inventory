<div {{ $attributes->merge(['class' => 'bg-gray-800 rounded-lg shadow-lg flex flex-col']) }}>
    @if (isset($header))
        <div class="p-4 border-b border-gray-700">
            {{ $header }}
        </div>
    @endif

    <div class="p-6 flex-grow">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="p-4 border-t border-gray-700 rounded-b-lg">
            {{ $footer }}
        </div>
    @endif
</div>