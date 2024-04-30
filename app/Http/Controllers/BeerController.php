<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BeerController extends Controller
{
    public function index()
    {
        $beers = Cache::rememberForever('beers', fn () => Beer::all());

        return view('beers.index', [
            'beers' => $beers,
        ]);
    }

    public function create()
    {
        return view('beers.create', [
            'styles' => Style::select('id', 'name')->get(),
            'breweries' => Brewery::select('id', 'name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'brewery_id' => 'required',
            'style_id' => 'required',
            'abv' => 'required'
        ]);

        $newBeer = Beer::create($validateData);

        return redirect('/beers')->with('success', "{$newBeer->name} was created with success");
    }

    public function edit(Beer $beer)
    {
        return view('beers.edit', [
            'beer' => $beer,
            'styles' => Style::select('id', 'name')->get(),
            'breweries' => Brewery::select('id', 'name')->get()
        ]);
    }

    public function update(Beer $beer)
    {
        $validateData = request()->validate([
            'name' => 'required',
            'brewery_id' => 'required',
            'style_id' => 'required',
            'abv' => 'required'
        ]);

        $beer->update($validateData);

        return redirect('/beers')->with('success', "{$beer->name} was updated with success");
    }

    public function destroy(Beer $beer)
    {
        $beer->delete();

        return back()->with('success', 'Beer deleted with success');
    }
}
