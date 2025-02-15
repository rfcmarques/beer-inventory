<div class="row">
    <div class="w-25">
        <h4 class="mb-3">Filters</h4>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $openAccordions['breweries'] ? '' : 'collapsed' }}"
                        wire:click="toggleAccordion('breweries')" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseBreweries"
                        aria-expanded="{{ $openAccordions['breweries'] ? 'true' : 'false' }}"
                        aria-controls="flush-collapseBreweries">
                        Breweries
                    </button>
                </h2>
                <div id="flush-collapseBreweries"
                    class="accordion-collapse collapse {{ $openAccordions['breweries'] ? 'show' : '' }}">
                    <div class="accordion-body" style="max-height: 200px; overflow-y: auto">
                        <ul class="list-unstyled lh-lg">
                            @forelse ($breweries as $brewery)
                                <li wire:key="{{ $brewery->id }}">
                                    <input class="form-check-input" type="checkbox" value="{{ $brewery->id }}"
                                        id="brewery-{{ $brewery->id }}" wire:model.live="selectedBreweries">
                                    <label class="form-check-label" for="brewery-{{ $brewery->id }}">
                                        {{ $brewery->name }}
                                    </label>
                                </li>
                            @empty
                                <li>
                                    No breweries found.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $openAccordions['styles'] ? '' : 'collapsed' }}"
                        wire:click="toggleAccordion('styles')" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseSytles"
                        aria-expanded="{{ $openAccordions['styles'] ? 'true' : 'false' }}"
                        aria-controls="flush-collapseSytles">
                        Styles
                    </button>
                </h2>
                <div id="flush-collapseSytles"
                    class="accordion-collapse collapse {{ $openAccordions['styles'] ? 'show' : '' }}">
                    <div class="accordion-body" style="max-height: 200px; overflow-y: auto">
                        <ul class="list-unstyled lh-lg">
                            @forelse ($styles as $style)
                                <li wire:key="{{ $style->id }}">
                                    <input class="form-check-input" type="checkbox" value="{{ $style->id }}"
                                        id="style-{{ $style->id }}" wire:model.live="selectedStyles">
                                    <label class="form-check-label" for="style-{{ $style->id }}">
                                        {{ $style->name }}
                                    </label>
                                </li>
                            @empty
                                <li>
                                    No styles found.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-75">
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
