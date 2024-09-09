<x-layout>
    <x-container title="Edit Brewery">
        <x-card>
            <x-form.form action="/breweries/{{ $brewery->id }}" method="put" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <x-form.input label="Name" name="name" :value="$brewery->name" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-form.label label="Country" name="country" />
                        <livewire:searchable-select :options="$countries" :selectedOption="$brewery->country ?? null" name="country" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <x-form.input label="Logo Image" name="logo" type="file" :value="$brewery->logo" />
                    </div>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
