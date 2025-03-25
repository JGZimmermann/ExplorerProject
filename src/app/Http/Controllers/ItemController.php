<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ItemRepository;
use App\Http\Requests\StoreItemRequest;

class ItemController extends Controller
{
    public function __construct(protected ItemRepository $itemRepository)
    {
    }

    public function index()
    {
        return response()->json($this->itemRepository->getAllItems());
    }

    public function show($id)
    {
        return response()->json($this->itemRepository->getItemsById($id));
    }

    public function store(StoreItemRequest $request)
    {
        $item = $this->itemRepository->storeItem($request->validated());
        return "O item ".$item->name." foi criado!";
    }
}
