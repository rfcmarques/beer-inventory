<x-layout>

    <x-success-msg />

    <x-container title="Inventory" :button="['endpoint' => '/items/create', 'text' => 'Add']">
        <x-item-card>
            <x-item-table :items="$items" />
        </x-item-card>
    </x-container>

</x-layout>
