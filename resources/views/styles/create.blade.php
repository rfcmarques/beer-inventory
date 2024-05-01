<x-layout>
    <x-container title="Create Style">
        <x-card>
            <x-form.form endpoint="/styles">
                <div class="col-md-6">
                    <x-form.input name="name" label="Style Name" value="{{ old('name') }}" />
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
