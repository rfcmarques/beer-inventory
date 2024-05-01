<x-layout>
    <x-container title="Edit Style">
        <x-card>
            <x-form.form endpoint="/styles/{{ $style->id }}" method="put">
                <x-form.field>
                    <x-form.label for="name">Style Name</x-form.label>
                    <x-form.input name="name" value="{{ old('name') ?? $style->name }}" />
                </x-form.field>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
