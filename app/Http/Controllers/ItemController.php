<?php

namespace App\Http\Controllers;

use App\Models\Beer;
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
        return view('items.create', [
            'beers' => Beer::select(['id', 'name'])->get(),
            'containers' => [
                'Bottle 250ml',
                'Bottle 330ml',
                'Bottle 375ml',
                'Bottle 500ml',
                'Bottle 750ml',
                'Can 330ml',
                'Can 355ml',
                'Can 440ml',
                'Can 473ml'
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'beer_id' => 'required',
            'expiration_date' => 'required',
            'quantity' => 'required|min:1',
            'container' => 'required'
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
        return view('items.edit', [
            'item' => $item,
            'beers' => Beer::select(['id', 'name'])->get(),
            'containers' => [
                'Bottle 250ml',
                'Bottle 330ml',
                'Bottle 375ml',
                'Bottle 500ml',
                'Bottle 750ml',
                'Can 330ml',
                'Can 355ml',
                'Can 440ml',
                'Can 473ml'
            ]
        ]);
    }

    public function update(Item $item)
    {
        $validatedData = request()->validate([
            'beer_id' => 'required',
            'expiration_date' => 'required',
            'container' => 'required'
        ]);

        $item->update($validatedData);

        if (Cache::has('items')) {
            Cache::forget('items');
        }

        return redirect('/items')->with('success', "Item was edited with success");
    }

    public function destroy(Item $item)
    {
        $item->delet();

        if (Cache::has('items')) {
            Cache::forget('items');
        }

        return redirect('/items')->with('success', "Item was deleted with success");
    }
}
