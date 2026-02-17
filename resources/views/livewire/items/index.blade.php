<div>
    <div class="flex justify-between items-center">
        <h1 class="mb-6 text-4xl font-extrabold text-white md:text-5xl">Items</h1>
        @can('create', App\Models\Item::class)
            <livewire:items.modal />
        @endcan
    </div>

    <x-card class="mt-6">
        <livewire:items.data-table />
    </x-card>
</div>