<div>
    <div class="flex flex-row items-center justify-between space-x-25">
        <div class="flex flex-row items-center justify-between mr-80">
            <p class="text-white text-nowrap mr-6">Per Page</p>
            <x-form.select class="ml-4 w-20 ring-2 ring-gray-400" id="per_page" :options="$perPageOptions" value="10"
                variant="dark" wire:model.live="perPage" />
        </div>
        <x-form.input type="text"
            class="max-w max-w-xl block w-full px-4 py-2 rounded-lg bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-600"
            id="search" placeholder="Search..." wire:model.live.debounce.500ms="search" />
    </div>
    <div class="mt-6">
        <x-table variant="dark">
            <x-slot:header>
                <tr class="text-xs font-medium uppercase">
                    <x-table.heading sortable wire:click="changeOrderAndDirection('beer.name')"
                        :direction="$orderBy === 'beer.name' ? $orderDirection : null">
                        Beer
                    </x-table.heading>

                    <x-table.heading sortable wire:click="changeOrderAndDirection('beer.brewery.name')"
                        :direction="$orderBy === 'beer.brewery.name' ? $orderDirection : null">
                        Brewery
                    </x-table.heading>

                    <x-table.heading sortable wire:click="changeOrderAndDirection('beer.style.name')"
                        :direction="$orderBy === 'beer.style.name' ? $orderDirection : null">
                        Style
                    </x-table.heading>

                    <x-table.heading noIcon>
                        Container
                    </x-table.heading>

                    <x-table.heading sortable wire:click="changeOrderAndDirection('expiration_date')"
                        :direction="$orderBy === 'expiration_date' ? $orderDirection : null">
                        Best Before
                    </x-table.heading>

                    @can(['update', 'delete'], $items->first())
                        <x-table.heading noIcon />
                    @endcan
                </tr>
            </x-slot:header>

            @forelse ($items as $item)
                <tr @class([
                    'text-sm',
                    'bg-white/5' => $loop->odd === 'dark',
                    'bg-neutral-50' => $loop->odd === 'light',
                ]) :class="{
                    'transition-colors duration-150 hover:bg-gray-100': variant === 'light',
                    'transition-colors duration-150 hover:bg-gray-800': variant === 'dark'
                }">
                    <td class="px-5 py-4 font-extrabold whitespace-nowrap text-left">
                        <button class="transition-colors duration-200 cursor-pointer"
                            @click="$dispatch('edit-item', { item: {{ $item->id }} })">
                            {{ $item->beer->name }}
                        </button>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-left">{{ $item->beer->style->name }}</td>
                    <td class="px-5 py-4 whitespace-nowrap text-left">{{ $item->beer->brewery->name }}</td>
                    <td class="px-5 py-4 whitespace-nowrap text-left">{{ $item->container->label }}</td>
                    <td class="px-5 py-4 whitespace-nowrap text-left">{{ $item->expiration_date->diffForHumans() }}</td>
                    @can(['update', 'delete'], $item)
                        <td class="px-5 py-4 font-medium text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-x-2">
                                <livewire:items.consumption-modal :item="$item" />
                                <button class="transition-colors duration-200 cursor-pointer"
                                    wire:click="delete({{ $item->id }})"
                                    wire:confirm="Are you sure you want to delete this item?">
                                    <x-icons.trash class="w-6 h-6 hover:text-red-800" color="danger" />
                                </button>
                            </div>
                        </td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No items found.</td>
                </tr>
            @endforelse 
        </x-table>
        <div class="mt-4 text-right text-white">
            {{ $items->onEachSide(1)->links() }}
        </div>
    </div>
</div>