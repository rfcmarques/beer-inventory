<?php

namespace App\Http\Controllers;

use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StyleController extends Controller
{
    function index()
    {
        $styles = Cache::rememberForever('styles', fn () => Style::all());

        return view('styles.index', [
            'styles' => $styles
        ]);
    }
}
