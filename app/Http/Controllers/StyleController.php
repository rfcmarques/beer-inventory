<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStyleRequest;
use App\Http\Requests\UpdateStyleRequest;
use App\Models\Style;

class StyleController extends Controller
{
    public function index()
    {
        return view('styles.index');
    }

    public function create()
    {
        return view('styles.create');
    }

    public function store(StoreStyleRequest $request)
    {
        $validatedData = $request->validated();

        $newStyle = Style::create($validatedData);

        return redirect('/styles')->with('success', "{$newStyle->name} was created with success");
    }

    public function edit(Style $style)
    {
        return view('styles.edit', [
            'style' => $style
        ]);
    }

    public function update(UpdateStyleRequest $request, Style $style)
    {
        $validatedData = $request->validated();

        $style->update($validatedData);


        return redirect('/styles')->with('success', "{$style->name} was updated with success");
    }

    public function destroy(Style $style)
    {
        $style->delete();

        return back()->with('success', 'Style deleted with success');
    }
}
