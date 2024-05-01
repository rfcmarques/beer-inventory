<x-layout>
    <x-container title="Create Style">
        <x-card>
            <x-form.form endpoint="/styles">
                <x-form.field>
                    <x-form.label for="name">Style Name</x-form.label>
                    <x-form.input name="name" value="{{ old('name') }}" />
                </x-form.field>
            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
