<div>
    <div class="my-3 d-flex">
        <p class="me-2 mt-2">Per Page</p>
        <div class="me-auto">
            <select class="form-select" wire:model.live="perPage">
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="d-flex align-items-center gap-2">
            <label for="search">Search:</label>
            <input class="form-control" id="search" type="text" wire:model.live.debounce.300ms="search">
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <th wire:click="doSort('beer_name')">
                <div class="d-flex">
                    Beer
                    <span class="ms-auto"><i class="fa-solid fa-chevron-up"></i></span>
                </div>
            </th>
            <th wire:click="doSort('beer_style')">
                <div class="d-flex">
                    Style
                    <span class="ms-auto"><i class="fa-solid fa-chevron-up"></i></span>
                </div>
            </th>
            <th wire:click="doSort('beer_brewery')">
                <div class="d-flex">
                    Brewery
                    <span class="ms-auto"><i class="fa-solid fa-chevron-up"></i></span>
                </div>
            </th>
            <th wire:click="doSort('container_id')">
                <div class="d-flex">
                    Container
                    <span class="ms-auto"><i class="fa-solid fa-chevron-up"></i></span>
                </div>
            </th>
            <th wire:click="doSort('expiration_date')">
                <div class="d-flex">
                    Best Before
                    <span class="ms-auto"><i class="fa-solid fa-chevron-up"></i></span>
                </div>
            </th>
            <th></th>
        </thead>
        <tbody class="table-group-divider">
            @forelse ($items as $item)
                <tr>
                    <td>
                        <a class="text-decoration-none fw-semibold text-dark" href="/items/{{ $item->id }}/edit">
                            {{ $item->beer->name }}
                        </a>
                    </td>
                    <td>{{ $item->beer->style->name ?? 'N/A' }}</td>
                    <td>{{ $item->beer->brewery->name ?? 'N/A' }}</td>
                    <td>{{ $item->container->type }} {{ $item->container->capacity }} ml</td>
                    <td title="{{ $item->expiration_date->format('Y-m-d') }}">
                        {{ $item->expiration_date->diffForHumans() }}
                    </td>
                    <td>
                        @can('update', $item)
                            <x-modal-button class="btn" target="#modal" wire:click="changeItemId({{ $item->id }})">
                                <i class="fa-solid fa-beer-mug-empty"></i>
                            </x-modal-button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%">
                        No results found
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

    {{ $items->onEachSide(1)->links() }}


    <x-modal id="modal">
        <x-slot:header>Register new consumption</x-slot:header>

        <x-form.form action="{{ route('consume', ['item' => $item_id]) }}" method="put">
            <div class="mb-3">
                <x-form.input class="mb-3" label="Date of Consumption" name="consumed_at" type="date" />
            </div>
        </x-form.form>
    </x-modal>
</div>
