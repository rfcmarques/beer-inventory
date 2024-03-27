<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Editar estilo</h1>
        </div>
        <div class="card-body">
            <x-form.form endpoint="/styles/{{ $style->id }}" method="put">
                <div class="col-md-6">
                    <x-form.input name="name" label="Style Name" value="{{ old('name') ?? $style->name }}" />
                </div>
            </x-form.form>
        </div>
    </div>
</x-layout>
