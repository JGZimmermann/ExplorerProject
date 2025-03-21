<?php

namespace App\Http\Controllers;

use App\Http\Services\ExplorerService;
use App\Http\Requests\StoreExplorerRequest;
use App\Http\Requests\UpdateExplorerRequest;
use App\Http\Requests\TradeItemsRequest;
use App\Models\Explorer;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class ExplorerController extends Controller
{
    public function index()
    {
        $explorers = Explorer::all();
        return response()->json($explorers);
    }

    public function show(Explorer $explorer)
    {
        response()->json($explorer->inventory);
        return response()->json($explorer);
    }

    public function store(StoreExplorerRequest $request)
    {
        $validated = $request->validated();
        $explorer = Explorer::create($validated);
        return 'O explorador '.$explorer->name.' foi adicionado na base de dados!';
    }

    public function update(UpdateExplorerRequest $request,Explorer $explorer)
    {
        $validated = $request->validated();
        $explorer->update($validated);
        return response()->json($explorer);
    }

    public function trade(TradeItemsRequest $request)
    {
        $value1 = 0;
        $explorer1_id = 0;
        $explorer2_id = 0;
        $value2 = 0;
        $validated = $request->validated();

        if(is_array($validated['item_id1'])){
            foreach ($validated['item_id1'] as $item){
                $item1 = DB::table('items')->find($item);
                $value1 += $item1->value;
                $explorer1_id = $item1->explorer_id;
            }
        } else{
            $item = DB::table('items')->find($validated['item_id1']);
            $value1 = $item->value;
            $explorer1_id = $item->explorer_id;
        }

        if(is_array($validated['item_id2'])){
            foreach ($validated['item_id2'] as $item){
                $item2 = DB::table('items')->find($item);
                $value2 += $item2->value;
                $explorer2_id = $item2->explorer_id;
            }
        } else{
            $item = DB::table('items')->find($validated['item_id2']);
            $value2 = $item->value;
            $explorer2_id = $item->explorer_id;
        }

        if($value1 != $value2){
            return "Não foi possível continuar a operação, os valores não são equivalentes";
        } else {
            if(is_array($validated['item_id1'])){
                foreach ($validated['item_id1'] as $item){
                    $item1 = Item::find($item);
                    $item1->update(["explorer_id" => $explorer2_id]);
                }
            } else{
                $item = Item::find($validated['item_id1']);
                $item->update(["explorer_id" => $explorer2_id]);
            }

            if(is_array($validated['item_id2'])){
                foreach ($validated['item_id2'] as $item){
                    $item2 = Item::find($item);
                    $item2->update(["explorer_id" => $explorer1_id]);
                }
            } else{
                $item = Item::find($validated['item_id2']);
                $item->update(["explorer_id" => $explorer1_id]);
            }
            return "A troca de itens foi concluída!";
        }

    }
}
