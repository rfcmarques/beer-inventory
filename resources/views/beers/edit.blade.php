<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Create Beer</h1>
        </div>
        <div class="card-body">
            <x-form.form endpoint="/beers/{{ $beer->id }}" method="put">
                <div class="row">
                    <div class="col-md-6">
                        <x-form.input name="name" label="Beer Name" value="{{ old('name') ?? $beer->name }}" />
                    </div>
                    <div class="col-md-6">
                        <x-form.select name="brewery_id" label="Brewery" :options="$breweries"
                            value="{{ old('brewery_id') ?? $beer->brewery->id }}" />
                    </div>
                    <div class="col-md-6">
                        <x-form.select name="style_id" label="Style" :options="$styles"
                            value="{{ old('style_id') ?? $beer->style->id }}" />
                    </div>
                    <div class="col-md-6">
                        <x-form.input type="number" name="abv" label="ABV (%)"
                            value="{{ old('abv') ?? $beer->abv }}" />
                    </div>
                </div>
            </x-form.form>
        </div>
    </div>
</x-layout>
