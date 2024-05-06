<x-layout>
    <h1>Stats</h1>

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

    <h3>Beers</h3>
    <p>You have a total of {{ \App\Models\Beer::all()->count() }} different beers</p>

    <h3>Breweries</h3>
    <p>You have a total of {{ \App\Models\Brewery::all()->count() }} different breweries</p>

    <h3>Styles</h3>
    <p>You have a total of {{ \App\Models\Style::all()->count() }} different styles</p>
</x-layout>
