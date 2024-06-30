<x-layout>

    <x-success-msg />

    <x-container title="Inventory" :button="['endpoint' => '/items/create', 'text' => 'Add']">
        <x-card class="border shadow py-3 px-4">
            <x-item-table :items="$items" />

            {{-- {{ $items->onEachSide(1)->links() }} --}}
        </x-card>
    </x-container>

</x-layout>
