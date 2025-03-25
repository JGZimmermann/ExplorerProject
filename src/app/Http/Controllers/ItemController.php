<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ItemRepository;
use App\Http\Requests\StoreItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    public function __construct(protected ItemRepository $itemRepository)
    {
    }

    public function index()
    {
        return response()->json($this->itemRepository->getAllItems());
    }

    public function show(Item $item)
    {
        return response()->json($item);
    }

    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();
        $this->itemRepository->storeItem($request);
        return "O item ".$validated->name." foi criado!";
    }
}
