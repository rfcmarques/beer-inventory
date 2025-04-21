<x-layout>
    <x-success-msg />

    <x-container title="Breweries" :button="['endpoint' => '/breweries/create', 'text' => 'Add']">
        <livewire:breweries />
    </x-container>

</x-layout>
