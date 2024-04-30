<?php

namespace App\Http\Controllers;

use App\Models\Brewery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BreweryController extends Controller
{
    public function index()
    {
        $breweries = Cache::rememberForever('breweries', fn () => Brewery::all());

        return view('breweries.index', [
            'breweries' => $breweries
        ]);
    }

    public function create()
    {
        return view('breweries.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'country' => 'required'
        ]);

        $newBrewery = Brewery::create($validatedData);

        return redirect('/breweries')->with('success', "{$newBrewery->name} was created with success");
    }

    public function edit(Brewery $brewery)
    {
        return view('breweries.edit', ['brewery' => $brewery]);
    }

    public function update(Brewery $brewery)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'country' => 'required'
        ]);

        $brewery->update($validatedData);

        return redirect('/breweries')->with('success', "{$brewery->name} was updated with success");
    }

    public function destroy(Brewery $brewery)
    {
        $brewery->delete();

        return back()->with('success', 'Brewery deleted with success');
    }
}
