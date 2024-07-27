<x-layout>
    <x-success-msg />

    <x-container title="Beers" :button="['endpoint' => '/beers/create', 'text' => 'Add']">
        <livewire:beers />
    </x-container>
</x-layout>
