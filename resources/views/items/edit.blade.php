<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Create Style</h1>
        </div>
        <div class="card-body">
            <x-form.form endpoint="/items/{{ $item->id }}" method="put">
                <div class="row">
                    <div class="col-md-6">
                        <x-form.select name="beer_id" label="Beer" :options="$beers"
                            value="{{ old('beer_id') ?? $item->beer->id }}" />
                    </div>

                    <div class="col-md-6">
                        <x-form.input type="date" name="expiration_date" label="Best before"
                            value="{{ old('expiration_date') ?? $item->expiration_date->format('Y-m-d') }}" />
                    </div>

                    <div class="col-md-6">
                        <x-form.select name="container_id" label="Container" :options="$containers"
                            value="{{ old('container') ?? $item->container->id }}" />
                    </div>
                </div>
            </x-form.form>
        </div>
    </div>
</x-layout>
