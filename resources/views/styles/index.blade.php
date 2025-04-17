<x-layout>

    <x-success-msg />

    <x-container title="Styles" :button="['endpoint' => '/styles/create', 'text' => 'Add']">
        <livewire:beer-styles />
    </x-container>
</x-layout>
