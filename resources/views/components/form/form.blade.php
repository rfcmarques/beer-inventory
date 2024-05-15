@props(['endpoint', 'method' => 'post'])

<form action="{{ $endpoint }}" method="POST" enctype="multipart/form-data">
    @csrf

    @unless ($method === 'post')
        @method($method)
    @endunless

    <x-form.error-msg />

    {{ $slot }}

    <div class="mb-3">
        <button type="submit" class="btn btn-success">
            {{ $method === 'put' ? 'Edit' : 'Create' }}
        </button>
    </div>
</form>
