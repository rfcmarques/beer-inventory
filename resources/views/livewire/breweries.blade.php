<div class="row mt-4">
    <input type="text" class="form-control mb-3" placeholder="Search..." wire:model.live="search">
    
    @foreach ($breweries as $brewery)
        <x-brewery-card :$brewery />
    @endforeach
    <div x-intersect="$wire.load()">
        &nbsp;
    </div>
</div>
