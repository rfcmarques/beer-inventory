<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Beer;
use App\Models\Container;
use App\Models\Item;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller
{
    public function index()
    {
        $items = Cache::rememberForever('items', fn () => Item::available());

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

    public function store(StoreItemRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData = Arr::except($validatedData, 'quantity');

        for ($i = 0; $i < $request->quantity; $i++) {
            Item::create($validatedData);
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

    public function update(UpdateItemRequest $request, Item $item)
    {
        $validatedData = $request->validated();

        $item->update($validatedData);

        return redirect('/items')->with('success', "Item was edited with success");
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect('/items')->with('success', "Item was deleted with success");
    }
}
