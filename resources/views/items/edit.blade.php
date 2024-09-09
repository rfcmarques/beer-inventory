<x-layout>
    <x-container title="Create Item">
        <x-card>
            <x-form.form action="/items/{{ $item->id }}" method="put">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <x-form.label label="Beer" name="beer_id" />
                        <livewire:searchable-select :options="$beers" :selectedOption="$item->beer->id ?? null" name="beer_id" />
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
