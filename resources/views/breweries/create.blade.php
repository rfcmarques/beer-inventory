<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Create Brewery</h1>
        </div>
        <div class="card-body">
            <x-form.form endpoint="/breweries" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <x-form.input name="name" label="Name" value="{{ old('name') }}" />
                    </div>

                    <div class="col-md-6">
                        <x-form.select name="country" label="Country" :options="$countries" value="{{ old('country') }}" />
                    </div>
                </div>
            </x-form.form>
        </div>
    </div>
</x-layout>
