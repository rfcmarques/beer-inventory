<div>
    <div class="flex justify-between items-center">
        <h1 class="mb-6 text-4xl font-extrabold text-white md:text-5xl">Breweries</h1>
        @can('create', \App\Models\Brewery::class)
            <livewire:breweries.modal />
        @endcan
    </div>

    <div class="flex justify-center mb-5">
        <input type="text" placeholder="Search breweries..." wire:model.live.debounce.500ms="search"
            class="max-w max-w-xl block w-full px-4 py-2 rounded-lg bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-600">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($breweries as $brewery)
            <x-card>
                <div class="flex w-full items-center">

                    <div class="flex-grow">
                        <h2 class="text-xl font-bold text-white">{{ $brewery->name }}</h2>
                        <p class="pt-1.5 text-md text-gray-400">{{ $brewery->country->name }}</p>
                    </div>

                    <div class="ml-4 flex-shrink-0 items-center justify-between">
                        <img src="{{ Storage::url($brewery->logo) }}" alt="{{ $brewery->name }} Logo" class="h-30 w-30">
                    </div>

                </div>

                @can(['update', 'delete'], $brewery)
                    <x-slot:footer>
                        <div class="flex">
                            <div class="w-1/2 text-center">
                                <button type="button" wire:click="delete({{ $brewery->id }})"
                                    wire:confirm="Are you sure you want to delete this brewery?" @click="open = false"
                                    class="w-full py-2 font-medium text-red-500 transition-colors hover:bg-red-500/10 cursor-pointer">
                                    Delete
                                </button>
                            </div>
                            <div class="w-1/2 border-l border-gray-700 text-center">
                                <button type="button"
                                    @click="open = false; $dispatch('edit-brewery', { brewery: {{ $brewery->id }} })"
                                    class="w-full py-2 font-medium text-blue-400 transition-colors hover:bg-blue-500/10 cursor-pointer">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </x-slot:footer>
                @endcan
            </x-card>
        @empty
            <p class="text-center text-gray-500 col-span-3">No breweries found.</p>
        @endforelse

        <div x-intersect="$wire.load()">
            &nbsp;
        </div>
    </div>
</div>