<x-layout>
    <x-container title="Edit Brewery">
        <x-card>
            <x-form.form endpoint="/breweries/{{ $brewery->id }}" method="put">
                <div class="row">
                    <x-form.field>
                        <x-form.label for="name">Name</x-form.label>
                        <x-form.input name="name" value="{{ old('name') ?? $brewery->name }}" />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="name">Country</x-form.label>
                        <x-form.select name="country" label="Country">
                            @foreach ($countries as $country)
                                <x-form.option value="{{ $country }}" text="{{ $country }}"
                                    selectedValue="{{ old('country') ?? $brewery->country }}" />
                            @endforeach
                        </x-form.select>
                    </x-form.field>

                    <x-form.field class="col-md-12">
                        <x-form.label for="logo">Logo Image</x-form.label>
                        <x-form.input name="logo" type="file" value="{{ old('logo') ?? $brewery->logo }}" />
                    </x-form.field>
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
