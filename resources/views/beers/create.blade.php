<x-layout>
    <x-container title="Create Beer">
        <x-card>
            <x-form.form action="/beers">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <x-form.input label="Name" name="name" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.label label="Brewery" name="brewery_id" />
                        <livewire:searchable-select :options="$breweries" name="brewery_id" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.label label="Style" name="style_id" />
                        <livewire:searchable-select :options="$styles" name="style_id" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.input label="ABV (%)" type="number" name="abv" />
                    </div>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
