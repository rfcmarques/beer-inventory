<?php

namespace App\Http\Controllers;

use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StyleController extends Controller
{
    public function index()
    {
        $styles = Cache::rememberForever('styles', fn () => Style::all());

        return view('styles.index', [
            'styles' => $styles
        ]);
    }

    public function create()
    {
        return view('styles.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'style' => 'required|unique:styles'
        ]);

        $newStyle = Style::create($validatedData);

        if (Cache::has('styles')) {
            Cache::forget('styles');
        }

        return redirect('/styles')->with('success', "{$newStyle->style} was created with success");
    }

    public function edit(Style $style)
    {
        return view('styles.edit', [
            'style' => $style
        ]);
    }

    public function update(Style $style)
    {
        $validatedData = request()->validate([
            'style' => 'required|unique:styles'
        ]);

        $style->update($validatedData);

        if (Cache::has('styles')) {
            Cache::forget('styles');
        }

        return redirect('/styles')->with('success', "{$style->style} was updated with success");
    }

    public function destroy(Style $style)
    {
        $style->delete();

        if (Cache::has('styles')) {
            Cache::forget('styles');
        }

        return back()->with('success', 'Style deleted with success');
    }
}
