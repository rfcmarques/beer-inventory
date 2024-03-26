<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Edit Brewery</h1>
        </div>
        <div class="card-body">
            <x-form.form endpoint="/breweries/{{ $brewery->id }}" method="put">
                <div class="row">
                    <div class="col-md-6">
                        <x-form.input name="name" label="Name" value="{{ old('name') ?? $brewery->name }}" />
                    </div>

                    <div class="col-md-6">
                        <x-form.input name="country" label="Country"
                            value="{{ old('country') ?? $brewery->country }}" />
                    </div>
                </div>
            </x-form.form>
        </div>
    </div>
</x-layout>
