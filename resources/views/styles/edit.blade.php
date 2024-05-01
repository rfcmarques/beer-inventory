<x-layout>
    <x-container title="Edit Style">
        <x-card>
            <x-form.form endpoint="/styles/{{ $style->id }}" method="put">
                <div class="col-md-6">
                    <x-form.input name="name" label="Style Name" value="{{ old('name') ?? $style->name }}" />
                </div>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
