<?php

namespace App\Http\Controllers;

use App\Models\Style;
use Illuminate\Http\Request;

class StyleController extends Controller
{
    public function index()
    {
        $styles = Style::simplePaginate(9);

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
            'name' => 'required|unique:styles'
        ]);

        $newStyle = Style::create($validatedData);

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
            'name' => 'required|unique:styles'
        ]);

        $style->update($validatedData);


        return redirect('/styles')->with('success', "{$style->style} was updated with success");
    }

    public function destroy(Style $style)
    {
        $style->delete();

        return back()->with('success', 'Style deleted with success');
    }
}
