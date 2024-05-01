<x-layout>
    <x-success-msg />

    <x-container title="Beers" :button="['endpoint' => '/beers/create', 'text' => 'Add']">
        <div class="row">
            <div class="col-md-3">
                <h5>Filters</h5>
                <p>TBD</p>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <input type="text" class="form-control mb-3" placeholder="Search...">

                    <div class="overflow-x-hidden px-2" style="max-height:50vh">
                        @foreach ($beers as $beer)
                            <x-beer-card :$beer />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-layout>
