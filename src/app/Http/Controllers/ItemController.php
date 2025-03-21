<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
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

    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();
        $item = Item::create($validated);
        return "O item ".$item->name." foi criado!";
    }
}
