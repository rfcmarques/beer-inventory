<x-layout>
    <x-container title="Edit Beer">
        <x-card>
            <x-form.form action="/beers/{{ $beer->id }}" method="put">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <x-form.input label="Name" name="name" :value="$beer->name" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.select label="Brewery" name="brewery_id">
                            @foreach ($breweries as $brewery)
                                <x-form.option value="{{ $brewery->id }}" text="{{ $brewery->name }}"
                                    selectedValue="{{ $beer->brewery->id }}" />
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.select label="Style" name="style_id">orderBy('name')
                            @foreach ($styles as $style)
                                <x-form.option value="{{ $style->id }}" text="{{ $style->name }}"
                                    selectedValue="{{ $beer->style->id }}" />
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.input label="ABV (%)" type="number" name="abv" :value="$beer->abv" />
                    </div>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
