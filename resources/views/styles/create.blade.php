<x-layout>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Criar estilo</h1>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form action="/styles" method="post">
                    @csrf

                    <x-form.error-msg />

                    <div class="mb-3">
                        <label for="style" class="form-label">Style Name</label>
                        <input type="text" class="form-control @error('style') is-invalid @enderror" id="style"
                            name="style" value="{{ old('style') }}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-layout>
