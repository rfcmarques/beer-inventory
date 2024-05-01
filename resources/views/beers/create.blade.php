<x-layout>
    <x-container title="Create Beer">
        <x-card>
            <x-form.form endpoint="/beers">
                <div class="row">
                    <x-form.field>
                        <x-form.label for="name">Name</x-form.label>
                        <x-form.input name="name" value="{{ old('name') }}" />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="brewery_id">Brewery</x-form.label>
                        <x-form.select name="brewery_id">
                            @foreach ($breweries as $key => $brewery)
                                <x-form.option value="{{ $brewery->id }}" text="{{ $brewery->name }}"
                                    selectedValue="{{ old('brewery_id') }}" />
                            @endforeach
                        </x-form.select>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="style_id">Style</x-form.label>
                        <x-form.select name="style_id">
                            @foreach ($styles as $key => $style)
                                <x-form.option value="{{ $style->id }}" text="{{ $style->name }}"
                                    selectedValue="{{ old('style_id') }}" />
                            @endforeach
                        </x-form.select>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="abv">ABV (%)</x-form.label>
                        <x-form.input type="number" name="abv" value="{{ old('abv') }}" />
                    </x-form.field>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
