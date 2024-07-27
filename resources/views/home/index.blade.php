<x-layout>
    <h1>Welcome to my stash!</h1>

    <div class="row mt-4 mb-5">
        <div class="col-3">
            <div class="card shadow border-1">
                <div class="card-body bg-text-info">
                    <h1 class="card-title mb-3">Items</h1>
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <h3>{{ App\Models\Item::available()->count() }} available</h3>
                            </div>
                            <div class="carousel-item">
                                <h5>{{ App\Models\Item::consumed()->count() }} consumed</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow border-1">
                <div class="card-body">
                    <h3 class="card-title">Beers</h3>
                    <h5>{{ \App\Models\Beer::all()->count() }}</h5>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow border-1">
                <div class="card-body">
                    <h3 class="card-title">Breweries</h3>
                    <h5>{{ \App\Models\Brewery::all()->count() }}</h5>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow border-1">
                <div class="card-body">
                    <h3 class="card-title">Styles</h3>
                    <h5>{{ \App\Models\Style::all()->count() }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3>Items</h3>
            <p>You have a total of {{ \App\Models\Item::available()->count() }} different items available in your
                inventory</p>
            <p>The following items will reach their best before date soon:</p>
            <ul>
                @foreach (\App\Models\Item::expiringSoon()->limit(5)->get() as $item)
                    <li>{{ $item->beer->name }}</li>
                @endforeach
            </ul>
            <p>You already consumed {{ \App\Models\Item::consumed()->count() }} items form your inventory</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3>Beers</h3>
            <p>You have a total of {{ \App\Models\Beer::all()->count() }} different beers,
                {{ \App\Models\Beer::consumed()->count() }} of wich were consumed once and
                {{ \App\Models\Beer::available()->count() }} are still available</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3>Breweries</h3>
            <p>You have a total of {{ \App\Models\Brewery::all()->count() }} different breweries</p>
            <p>From {{ \App\Models\Brewery::select('country')->distinct()->get()->count() }} different countries</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3>Styles</h3>
            <p>You have a total of {{ \App\Models\Style::all()->count() }} different styles</p>
        </div>
    </div>

</x-layout>
