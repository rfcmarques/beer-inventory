<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBreweryRequest;
use App\Http\Requests\UpdateBreweryRequest;
use App\Models\Brewery;
use App\Services\CountriesAPIService;
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
        $countries = CountriesAPIService::getCountriesByName();

        return view('breweries.create', [
            'countries' => $countries
        ]);
    }

    public function store(StoreBreweryRequest $request)
    {
        $validatedData = $request->validated();

        $newBrewery = Brewery::create($validatedData);

        return redirect('/breweries')->with('success', "{$newBrewery->name} was created with success");
    }

    public function edit(Brewery $brewery)
    {
        $countries = CountriesAPIService::getCountriesByName();

        return view('breweries.edit', [
            'brewery' => $brewery,
            'countries' => $countries
        ]);
    }

    public function update(UpdateBreweryRequest $request, Brewery $brewery)
    {
        $validatedData = $request->validated();

        $brewery->update($validatedData);

        return redirect('/breweries')->with('success', "{$brewery->name} was updated with success");
    }

    public function destroy(Brewery $brewery)
    {
        $brewery->delete();

        return back()->with('success', 'Brewery deleted with success');
    }
}
