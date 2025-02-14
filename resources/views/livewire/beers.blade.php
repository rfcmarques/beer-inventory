<div class="row">
    <div class="col-md-3">
        <h4 class="mb-3">Filters</h4>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item" wire:ignore>
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Breweries
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse">
                    <div class="accordion-body" style="max-height: 200px; overflow-y: auto">
                        <ul class="list-unstyled lh-lg">
                            @foreach ($breweries as $brewery)
                                <li wire:key="{{ $brewery->id }}">
                                    <input class="form-check-input" type="checkbox" value="{{ $brewery->id }}"
                                        id="brewery-{{ $brewery->id }}" wire:model.live="selectedBreweries">
                                    <label class="form-check-label" for="brewery-{{ $brewery->id }}">
                                        {{ $brewery->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item" wire:ignore>
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Styles
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body" style="max-height: 200px; overflow-y: auto">
                        <ul class="list-unstyled lh-lg">
                            @foreach ($styles as $style)
                                <li wire:key="{{ $style->id }}">
                                    <input class="form-check-input" type="checkbox" value="{{ $style->id }}"
                                        id="style-{{ $style->id }}" wire:model.live="selectedStyles">
                                    <label class="form-check-label" for="style-{{ $style->id }}">
                                        {{ $style->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="d-flex flex-column">
            <input type="text" class="form-control mb-3" placeholder="Search..." wire:model.live="search">

            <div class="overflow-x-hidden px-2" style="max-height: 80vh; overflow-y: auto">
                @forelse ($beers as $beer)
                    <x-beer-card :$beer />
                @empty
                    <div class="text-center">
                        <p class="text-muted">
                            No beers found. Try removing some filters.
                        </p>
                    </div>
                @endforelse
                <div x-intersect="$wire.load()">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</div>
