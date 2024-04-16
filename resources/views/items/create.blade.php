<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Create Style</h1>
        </div>
        <div class="card-body">
            <x-form.form endpoint="/items" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <x-form.select name="beer_id" label="Beer" :options="$beers" value="{{ old('beer') }}" />
                    </div>

                    <div class="col-md-6">
                        <x-form.input type="date" name="expiration_date" label="Best before"
                            value="{{ old('name') }}" />
                    </div>

                    <div class="col-md-6">
                        <x-form.input type="number" name="quantity" label="Quantity" value="{{ old('quantity') }}" />
                    </div>

                    <div class="col-md-6">
                        <x-form.select name="container_id" label="Container" :options="$containers"
                            value="{{ old('container') }}" />
                    </div>
                </div>
            </x-form.form>
        </div>
    </div>
</x-layout>
