<x-layout>
    <x-container title="Create Item">
        <x-card>
            <x-form.form action="/items">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <x-form.select label="Beer" name="beer_id">
                            @foreach ($beers as $beer)
                                <x-form.option value="{{ $beer->id }}" text="{{ $beer->name }}"
                                    selectedValue="{{ old('beer_id') }}" />
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.input label="Best Before" type="date" name="expiration_date"
                            value="{{ old('expiration_date') }}" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.input label="Quantity" type="number" name="quantity" value="{{ old('quantity') }}" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.select label="Container" name="container_id">
                            @foreach ($containers as $container)
                                <x-form.option value="{{ $container->id }}"
                                    text="{{ $container->type . ' ' . $container->capacity . ' ml' }}"
                                    selectedValue="{{ old('container_id') }}" />
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
