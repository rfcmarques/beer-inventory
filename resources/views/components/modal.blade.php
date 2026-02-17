@props(['name', 'show' => false, 'title' => ''])

<div x-data="{ show: @entangle($attributes->wire('model')) }" x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })" x-show="show" x-on:keydown.escape.window="show = false"
    class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0" style="display: none;">
    <!-- Overlay -->
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
    </div>

    <!-- Modal Content -->
    <div x-show="show"
        class="relative z-10 mb-6 bg-white rounded-lg overflow-visible shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        @if($title)
            <div class="px-6 py-4 bg-gray-100 border-b border-gray-200 rounded-t-lg">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $title }}
                </h3>
            </div>
        @endif

        <div class="px-6 py-4">
            {{ $slot }}
        </div>

        @if(isset($footer))
            <div class="px-6 py-4 bg-gray-50 text-right rounded-b-lg">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>