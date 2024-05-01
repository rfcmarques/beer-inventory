<x-layout>
    <x-container title="Create Item">
        <x-card>
            <x-form.form endpoint="/items">
                <div class="row">
                    <x-form.field>
                        <x-form.label for="beer_id">Beer</x-form.label>
                        <x-form.select name="beer_id">
                            @foreach ($beers as $beer)
                                <x-form.option value="{{ $beer->id }}" text="{{ $beer->name }}"
                                    selectedValue="{{ old('beer_id') }}" />
                            @endforeach
                        </x-form.select>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="expiration_date">Best Before</x-form.label>
                        <x-form.input type="date" name="expiration_date" value="{{ old('expiration_date') }}" />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="quantity">Quantity</x-form.label>
                        <x-form.input type="number" name="quantity" value="{{ old('quantity') }}" />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="container_id">Container</x-form.label>
                        <x-form.select name="container_id">
                            @foreach ($containers as $container)
                                <x-form.option value="{{ $container->id }}"
                                    text="{{ $container->type . ' ' . $container->capacity . ' ml' }}"
                                    selectedValue="{{ old('container_id') }}" />
                            @endforeach
                        </x-form.select>
                    </x-form.field>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
