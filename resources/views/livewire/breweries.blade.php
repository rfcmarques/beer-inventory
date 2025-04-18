<div class="row mt-4">
    <input type="text" class="form-control mb-3" placeholder="Search..." wire:model.live="search">

    <div style="max-height: 80vh; overflow-y: auto">
        <div class="row">
            @foreach ($breweries as $brewery)
                <x-brewery-card :$brewery />
            @endforeach
            <div x-intersect="$wire.load()">
                &nbsp;
            </div>
        </div>
    </div>
</div>
