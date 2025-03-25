<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExplorerRequest;
use App\Http\Requests\TradeItemsRequest;
use App\Http\Requests\UpdateExplorerRequest;
use App\Http\Services\ExplorerService;

class ExplorerController extends Controller
{
    public function __construct(protected ExplorerService $explorerService)
    {
    }
    public function index()
    {
        return response()->json($this->explorerService->getExplorers());
    }

    public function show($id)
    {
        return response()->json($this->explorerService->getExplorerById($id));
    }

    public function store(StoreExplorerRequest $request)
    {
        $explorer = $this->explorerService->storeExplorer($request->validated());
        return 'O explorador '.$explorer->name.' foi adicionado na base de dados!';
    }

    public function update(UpdateExplorerRequest $request,$id)
    {
        $this->explorerService->updateExplorer($request->validated(),$id);
        return response()->json($this->explorerService->getExplorerById($id));
    }

    public function trade(TradeItemsRequest $request)
    {
        $this->explorerService->tradeItems($request);
        return "A troca de itens foi concluída!";
    }
}
