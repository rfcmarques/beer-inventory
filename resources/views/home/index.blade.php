<x-layout>
    <h1>Welcome to my stash!</h1>

    <div class="row mt-4 mb-5">
        <div class="col-3">
            <div class="card shadow border-1 border-primary bg-primary bg-gradient text-white">
                <div class="card-body bg-text-info">
                    <h3 class="card-title">Items</h3>
                    <h5>{{ \App\Models\Item::all()->count() }}</h5>
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
            <p>You have a total of {{ \App\Models\Item::all()->count() }} different items in your inventory</p>
            <p>The following items will reach their best before date soon</p>
            <ul>
                <li>ABC</li>
                <li>ABC</li>
                <li>ABC</li>
                <li>ABC</li>
                <li>ABC</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3>Beers</h3>
            <p>You have a total of {{ \App\Models\Beer::all()->count() }} different beers</p>
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
