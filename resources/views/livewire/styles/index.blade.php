<div>

    <div class="flex justify-between items-center">
        <h1 class="mb-6 text-4xl font-extrabold text-white md:text-5xl">Styles</h1>

        @can('create', \App\Models\Style::class)
            <livewire:styles.modal />
        @endcan
    </div>

    <div class="flex justify-center mb-5">
        <input type="text" placeholder="Search styles..." wire:model.live.debounce.300ms="search"
            class="max-w max-w-xl block w-full px-4 py-2 rounded-lg bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-600">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($beerStyles as $style)
            <x-card class="transition-all duration-300 hover:scale-105 hover:bg-gray-700 hover:shadow-xl">
                <div class="flex w-full items-center">
                    <a href="/styles/{{ $style->id }}" class="flex flex-grow items-center">
                        <div class="mr-5 flex-shrink-0">
                            @php
                                $colors = ['red', 'green', 'blue', 'yellow', 'purple', 'pink', 'indigo', 'gray'];
                                $randomColor = $colors[array_rand($colors)];
                            @endphp
                            <x-icons.hop class="h-15 w-15" color="{{ $randomColor }}" />
                        </div>

                        <div class="flex-grow text-center">
                            <h2 class="text-lg font-bold text-white">{{ $style->name }}</h2>

                            @if ($style->quantity_available > 0 || $style->quantity_consumed > 0)
                                <div class="flex items-center justify-center pt-1.5 text-sm">
                                    @unless ($style->quantity_available < 1)
                                        <x-badge color="green" class="mr-2">Available</x-badge>
                                    @endunless

                                    @unless ($style->quantity_consumed < 1)
                                        <x-badge color="blue">Consumed</x-badge>
                                    @endunless
                                </div>
                            @endif

                            <p class="pt-1.5 text-sm text-gray-400">{{ $style->quantity_beers }} beers</p>
                        </div>
                    </a>

                    @can(['update', 'delete'], $style)
                        <div class="ml-5 flex-shrink-0 relative" x-data="{ open: false }">
                            <button @click="open = !open" type="button"
                                class="-m-2.5 p-2.5 flex items-center justify-center text-gray-400 hover:text-gray-300">
                                <span class="sr-only">Open options</span>
                                <x-icons.three-dots-vertical />
                            </button>

                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-gray-800 py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                style="display: none;">

                                <button type="button"
                                    @click="open = false; $dispatch('edit-style', { style: {{ $style->id }} })"
                                    class="block w-full px-3 py-1 text-left text-sm leading-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Edit
                                </button>

                                <button type="button" wire:click="delete({{ $style->id }})"
                                    wire:confirm="Are you sure you want to delete this style?" @click="open = false"
                                    class="block w-full px-3 py-1 text-left text-sm leading-6 text-red-400 hover:bg-gray-700 hover:text-red-300">
                                    Delete
                                </button>
                            </div>
                        </div>
                    @endcan
                </div>
            </x-card>
        @empty
            <p class="text-center text-gray-500 col-span-3">No styles found.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $beerStyles->links() }}
    </div>


</div>