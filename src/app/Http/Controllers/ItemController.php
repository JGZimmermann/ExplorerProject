<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    public function show(Item $item)
    {
        return response()->json($item);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'value' => 'required',
            'localization_id' => 'required|Integer',
            'explorer_id' => 'required|Integer'
        ]);

        $item = Item::create($validated);
        return "O item ".$item->name." foi criado!";
    }
}
