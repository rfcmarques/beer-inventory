<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemConsumedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Item $item)
    {
        $item->update([
            'consumed_at' => now()
        ]);

        return redirect('/items')
            ->with('success', "Cheers! You just drank {$item->beer->name}. Hope it was a nice experience 🍻");
    }
}
