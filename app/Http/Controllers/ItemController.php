<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    function index()
    {
        return view('items.index', [
            'items' => Item::all()
        ]);
    }
}
