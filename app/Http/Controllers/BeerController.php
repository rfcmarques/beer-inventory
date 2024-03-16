<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    function index()
    {
        return Beer::all();
    }
}
