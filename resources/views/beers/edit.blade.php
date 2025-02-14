<x-layout>
    <x-container title="Edit Beer">
        <x-card>
            <x-form.form action="/beers/{{ $beer->id }}" method="put">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <x-form.input label="Name" name="name" :value="$beer->name" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.label label="Brewery" name="brewery_id" />
                        <livewire:searchable-select :options="$breweries" :selectedOption="$beer->brewery->id ?? null" name="brewery_id" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.label label="Style" name="style_id" />
                        <livewire:searchable-select :options="$styles" :selectedOption="$beer->style->id ?? null" name="style_id" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.input label="ABV (%)" type="number" name="abv" :value="$beer->abv" />
                    </div>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
