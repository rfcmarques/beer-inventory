<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller
{
    function index()
    {
        $items = Cache::rememberForever('items', fn () => Item::all());

        return view('items.index', [
            'items' => $items
        ]);
    }
}
