<x-card class="border-0 border-bottom border-5 {{ $border }} rounded-2 shadow">
    <h5 class="card-title">{{ $title }}</h5>
    <div class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">
            @foreach ($carousels as $title => $carousel)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    @php
                        $text = is_string($title) ? ucfirst($title) . ": {$carousel}" : "{$carousel}";
                    @endphp
                    <h3>{{ $text }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</x-card>
