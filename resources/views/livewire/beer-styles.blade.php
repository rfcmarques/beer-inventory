<div>
    <div class="row mt-4">
        <input type="text" class="form-control mb-3" placeholder="Search..." wire:model.live="search">

        @forelse ($styles as $style)
            <x-style-card :$style></x-style-card>
        @empty
            <div class="text-center">
                <p class="text-muted">
                    No styles found.
                </p>
            </div>
        @endforelse

        {{ $styles->links() }}
    </div>
</div>
