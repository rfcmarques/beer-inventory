<x-layout>
    <x-success-msg />

    <x-container title="Breweries" :button="['endpoint' => '/breweries/add', 'text' => 'Create']">
        <div class="row mt-4">
            @foreach ($breweries as $brewery)
                <x-brewery-card :brewery="$brewery" />
            @endforeach
        </div>
    </x-container>

</x-layout>
