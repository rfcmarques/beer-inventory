<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Container;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller
{
    public function index()
    {
        $items = Cache::rememberForever('items', fn () => Item::all());

        return view('items.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        $containers = Cache::rememberForever('containers', fn () => Container::all());

        $beers = Cache::get('beers')
            ?? Beer::select(['id', 'name'])->get();

        return view('items.create', [
            'beers' => $beers,
            'containers' => $containers,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'beer_id' => 'required',
            'container_id' => 'required',
            'expiration_date' => 'required',
            'quantity' => 'required|min:1',
        ]);

        $validatedData = Arr::except($validatedData, 'quantity');

        for ($i = 0; $i < $request->quantity; $i++) {
            Item::create($validatedData);
        }

        if (Cache::has('items')) {
            Cache::forget('items');
        }

        return redirect('/items')->with('success', "New item was created with success");
    }

    public function edit(Item $item)
    {
        $beers = Cache::get('beers')
            ?? Beer::select(['id', 'name'])->get();

        $containers = Cache::get('containers')
            ?? Container::select(['id', 'name'])->get();

        return view('items.edit', [
            'item' => $item,
            'beers' => $beers,
            'containers' => $containers
        ]);
    }

    public function update(Item $item)
    {
        $validatedData = request()->validate([
            'beer_id' => 'required',
            'expiration_date' => 'required',
            'container_id' => 'required'
        ]);

        $item->update($validatedData);

        if (Cache::has('items')) {
            Cache::forget('items');
        }

        return redirect('/items')->with('success', "Item was edited with success");
    }

    public function destroy(Item $item)
    {
        $item->delete();

        if (Cache::has('items')) {
            Cache::forget('items');
        }

        return redirect('/items')->with('success', "Item was deleted with success");
    }
}
