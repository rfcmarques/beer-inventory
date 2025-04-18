<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBreweryRequest;
use App\Http\Requests\UpdateBreweryRequest;
use App\Models\Brewery;
use App\Models\Country;
use App\Services\CountriesAPIService;
use Illuminate\Support\Facades\Cache;

class BreweryController extends Controller
{
    public function index()
    {
        return view('breweries.index');
    }

    public function create()
    {
        $countries = Cache::rememberForever('countries', fn() => Country::select('id', 'name')->orderBy('name')->get());

        return view('breweries.create', [
            'countries' => $countries
        ]);
    }

    public function store(StoreBreweryRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('public');
        }

        $newBrewery = Brewery::create($validatedData);

        return redirect('/breweries')->with('success', "{$newBrewery->name} was created with success");
    }

    public function edit(Brewery $brewery)
    {
        $countries = Cache::get('countries')
            ?? Cache::rememberForever('countries', fn() => Country::select('id', 'name')->orderBy('name')->get());

        return view('breweries.edit', [
            'brewery' => $brewery,
            'countries' => $countries
        ]);
    }

    public function update(UpdateBreweryRequest $request, Brewery $brewery)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('public');
        }

        $brewery->update($validatedData);

        return redirect('/breweries')->with('success', "{$brewery->name} was updated with success");
    }

    public function destroy(Brewery $brewery)
    {
        $brewery->delete();

        return back()->with('success', 'Brewery deleted with success');
    }
}
