@props(['button', 'title'])

<div class="container">
    <div class="d-flex flex-row align-items-center mb-3">
        <h1 class="me-auto">{{ $title }}</h1>
        @if ($button)
            <div class="col-2 d-grid">
                <a href="{{ $button['endpoint'] }}" class="btn btn-primary" role="button">{{ $button['text'] }}</a>
            </div>
        @endif
    </div>

    {{ $slot }}

</div>
