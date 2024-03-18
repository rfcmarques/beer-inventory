<?php

namespace App\Http\Controllers;

use App\Models\Brewery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BreweryController extends Controller
{
    function index()
    {
        $breweries = Cache::rememberForever('breweries', fn () => Brewery::all());

        return view('breweries.index', [
            'breweries' => $breweries
        ]);
    }
}
