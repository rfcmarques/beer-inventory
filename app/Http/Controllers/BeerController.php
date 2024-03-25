<?php

namespace App\Http\Controllers;

use App\Models\Beer;
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
}
