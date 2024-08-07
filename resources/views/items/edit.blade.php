<x-layout>
    <x-container title="Create Item">
        <x-card>
            <x-form.form action="/items/{{ $item->id }}" method="put">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <x-form.select label="Beer" name="beer_id">
                            @foreach ($beers as $beer)
                                <x-form.option value="{{ $beer->id }}" text="{{ $beer->name }}"
                                    selectedValue="{{ $item->beer->id }}" />
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.input label="Best Before" type="date" name="expiration_date"
                            value="{{ $item->expiration_date->format('Y-m-d') }}" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.select label="Container" name="container_id">
                            @foreach ($containers as $container)
                                <x-form.option value="{{ $container->id }}"
                                    text="{{ $container->type . ' ' . $container->capacity . ' ml' }}"
                                    selectedValue="{{ $item->container->id }}" />
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
