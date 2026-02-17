<div>
    <div class="flex justify-between items-center">
        <h1 class="mb-6 text-4xl font-extrabold text-white md:text-5xl">Beers</h1>
        
        @can('create', \App\Models\Beer::class)
            <livewire:beers.modal />
        @endcan
    </div>

    <div class="flex w-full mt-6 h-[calc(100vh-17rem)] overflow-hidden">
        <div class="w-1/3 rounded-l text-left h-full overflow-y-auto pr-2">
            <h3 class="mb-6 text-xl font-extrabold text-white md:text-4xl">Filters</h3>
            <x-accordion variant="transparent">

                <x-accordion.item id="breweries">
                    <x-slot:title>
                        Breweries
                    </x-slot:title>

                    <div class="space-y-2 max-h-62 overflow-y-scroll">
                        @foreach ($breweries as $brewery)
                            <x-form.checkbox id="brewery-{{ $brewery->id }}" name="selectedBreweries[]" value="{{ $brewery->id }}"
                                label="{{ $brewery->name }}" variant="dark" wire:model.live="selectedBreweries" />
                        @endforeach
                    </div>
                </x-accordion.item>

                <x-accordion.item id="styles">
                    <x-slot:title>
                        Styles
                    </x-slot:title>
                    <div class="space-y-2 max-h-62 overflow-y-scroll">
                        @foreach ($beerStyles as $style)
                            <x-form.checkbox id="style-{{ $style->id }}" name="selectedStyles[]" value="{{ $style->id }}"
                                label="{{ $style->name }}" variant="dark" wire:model.live="selectedStyles" />
                        @endforeach
                    </div>
                </x-accordion.item>


                <x-accordion.item id="countries">
                    <x-slot:title>
                        Country
                    </x-slot:title>

                    <div class="space-y-2">
                        @foreach ($countries as $country)
                            <x-form.checkbox id="country-{{ $country->id }}" name="selectedCountries[]" value="{{ $country->id }}"
                                label="{{ $country->name }}" variant="dark" wire:model.live="selectedCountries" />
                        @endforeach
                    </div>
                </x-accordion.item>

                <x-accordion.item id="Availability">
                    <x-slot:title>
                        Availability
                    </x-slot:title>

                    <div class="space-y-2">
                        <x-form.checkbox id="available" name="available" value="1" label="Available" variant="dark" wire:model.live="available" wire:click="toggleConsumed" />
                        <x-form.checkbox id="consumed" name="consumed" value="1" label="Consumed" variant="dark" wire:model.live="consumed" wire:click="toggleAvailable" />
                    </div>
                </x-accordion.item>
            </x-accordion>
        </div>
        <div class="w-2/3 p-4 rounded-r flex flex-col h-full">
            <div class="flex justify-between gap-6 mb-5 shrink-0">
                <input type="text" placeholder="Search beers..." wire:model.live.debounce.500ms="search"
                    class="max-w max-w-xl block w-full px-4 py-2 rounded-lg bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-600">

                <x-form.select id="sort" :options="$sortOptions" wire:model.live="sort" placeholder="Sort by" />

            </div>
            <div class="overflow-y-auto overflow-x-hidden grow pr-2">
                <div class="grid grid-cols-1 gap-4">
                    @forelse ($beers as $beer)
                        <x-card class="relative transition-all duration-300 hover:scale-105 hover:bg-gray-700 hover:shadow-xl">
                            <div class="flex items-center justify-between p-4">
                                <a href="#" class="flex flex-1 items-center gap-4">
                                    <div class="flex-shrink-0">
                                        @php
                                            $colors = ['red', 'green', 'blue', 'yellow', 'purple', 'pink', 'indigo', 'gray'];
                                            $randomColor = $colors[array_rand($colors)];
                                        @endphp
                                        <x-icons.hop class="h-15 w-15" color="{{ $randomColor }}" />
                                    </div>

                                    <div class="flex flex-1 items-center justify-between">
                                        <div class="flex flex-col items-start gap-1">
                                            <h2 class="text-2xl font-bold text-white text-left">{{ $beer->name }}</h2>
                                            <h3 class="text-lg font-bold text-white text-left">{{ $beer->brewery->name }}</h3>
                                            <p class="text-gray-400 text-left">{{ $beer->style->name }}</p>
                                        </div>

                                        <div class="flex flex-col items-center gap-2 shrink-0">
                                            @unless ($beer->quantity_available < 1)
                                                <x-badge color="green">Available</x-badge>
                                            @endunless
                                            
                                            @unless($beer->quantity_consumed < 1)
                                                <x-badge color="blue">Consumed</x-badge>
                                            @endunless
                                        </div>
                                    </div>
                                </a>

                                @can(['update', 'delete'], $beer)
                                    <div class="ml-4 flex-shrink-0 relative" x-data="{ open: false }">
                                        <button @click="open = !open" type="button"
                                            class="-m-2.5 p-2.5 flex items-center justify-center text-gray-400 hover:text-gray-300">
                                            <span class="sr-only">Open options</span>
                                            <x-icons.three-dots-vertical />
                                        </button>

                                        <div x-show="open" @click.away="open = false" x-transition
                                            class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-gray-800 py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                            style="display: none;">

                                            <button type="button"
                                                @click="open = false; $dispatch('edit-beer', { beer: {{ $beer->id }} })"
                                                class="block w-full px-3 py-1 text-left text-sm leading-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                                                Edit
                                            </button>

                                            <button type="button" wire:click="delete({{ $beer->id }})"
                                                wire:confirm="Are you sure you want to delete this beer?" @click="open = false"
                                                class="block w-full px-3 py-1 text-left text-sm leading-6 text-red-400 hover:bg-gray-700 hover:text-red-300">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </x-card>
                    @empty
                        <p class="text-center text-gray-500 col-span-3">No beers found.</p>
                    @endforelse
                    <div x-intersect="$wire.load()">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>