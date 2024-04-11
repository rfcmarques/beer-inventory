<x-layout>

    <x-container title="Inventory" :button="['endpoint' => '/items/create', 'text' => 'Add']">
        <x-item-card>
            <x-item-table :$items />
        </x-item-card>
    </x-container>

</x-layout>
