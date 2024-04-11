<x-layout>
    <x-success-msg />

    <x-container title="Beers" :button="['endpoint' => '/beers/create', 'text' => 'Add']">
        <div class="row">
            <div class="col-md-3">
                <h5>Filters</h5>
                <p>TBD</p>
            </div>
            <div class="col-md-6 overflow-auto" style="max-height: 50vh">
                <input type="text" class="form-control mb-3" placeholder="Search...">
                @foreach ($beers as $beer)
                    <x-beer-card :beer="$beer" />
                @endforeach
            </div>
        </div>
    </x-container>
</x-layout>
