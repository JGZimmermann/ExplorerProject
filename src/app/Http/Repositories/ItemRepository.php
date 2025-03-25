<?php

namespace App\Http\Repositories;

use App\Models\Item;

class ItemRepository
{
    public function getItemsById($id)
    {
        return Item::find($id);
    }

    public function getAllItems()
    {
        return Item::all();
    }

    public function storeItem($request)
    {
       return Item::create($request);
    }
}
