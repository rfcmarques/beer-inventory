@props(['endpoint', 'method' => 'post'])

<form {{ $attributes->merge(['method' => 'POST']) }}>
    @csrf

    @unless ($method === 'post')
        @method($method)
    @endunless

    {{ $slot }}

    <div class="mb-3">
        <button type="submit" class="btn btn-success">
            {{ $method === 'put' ? 'Edit' : 'Create' }}
        </button>
    </div>
</form>
