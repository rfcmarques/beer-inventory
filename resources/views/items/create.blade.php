<x-layout>
    <x-container title="Create Item">
        <x-card>
            <x-form.form action="/items">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <x-form.label label="Beer" name="beer_id" />
                        <livewire:searchable-select :options="$beers" name="beer_id" />
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
                                <x-form.option value="{{ $container->id }}" text="{{ $container->label }}"
                                    selectedValue="{{ old('container_id') }}" />
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
