<x-layout>
    <x-container title="Edit Style">
        <x-card>
            <x-form.form action="/styles/{{ $style->id }}" method="put">

                <div class="col-md-6 mb-3">
                    <x-form.input label="Style Name" name="name" :value="$style->name" />
                </div>

            </x-form.form>
        </x-card>
    </x-container>
</x-layout>
