<?php

namespace App\Http\Controllers;

use App\Models\Brewery;
use Illuminate\Http\Request;

class BreweryController extends Controller
{
    function index()
    {
        return view('breweries.index', [
            'breweries' => Brewery::all()
        ]);
    }
}
