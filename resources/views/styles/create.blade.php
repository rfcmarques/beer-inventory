<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Create Style</h1>
        </div>
        <div class="card-body">
            <x-form.form endpoint="/styles" method="post">
                <div class="col-md-6">
                    <x-form.input name="name" label="Style Name" value="{{ old('name') }}" />
                </div>
            </x-form.form>
        </div>
    </div>
</x-layout>
