<x-layout>
    <x-success-msg />

    <x-container title="Breweries" :button="['endpoint' => '/breweries/create', 'text' => 'Add']">
        <p x-text="$wire.breweries.length"></p>
        <livewire:breweries />
    </x-container>

</x-layout>
