<?php

namespace app\Http\Services;

use App\Http\Repositories\ExplorerRepository;
use App\Http\Repositories\ItemRepository;
use App\Http\Requests\TradeItemsRequest;

class ExplorerService
{

    public function __construct(protected ExplorerRepository $explorerRepository, protected ItemRepository $itemRepository)
    {
    }

    public function getExplorers()
    {
        return $this->explorerRepository->getAllExplorers();
    }

    public function storeExplorer($data)
    {
        return $this->explorerRepository->createExplorer($data);
    }

    public function getExplorerById($id)
    {
        return $this->explorerRepository->getExplorerById($id);
    }

    public function updateExplorer($data, $id)
    {
        $explorer = $this->getExplorerById($id);
        return $this->explorerRepository->updateExplorer($explorer,$data);
    }

    public function tradeItems(TradeItemsRequest $request)
    {
        $value1 = 0;
        $explorer1_id = 0;
        $explorer2_id = 0;
        $value2 = 0;
        $validated = $request->validated();

        if (is_array($validated['item_id1'])) {
            foreach ($validated['item_id1'] as $item) {
                $item1 = $this->itemRepository->getItemsById($item);
                $value1 += $item1->value;
                $explorer1_id = $item1->explorer_id;
            }
        } else {
            $item = $this->itemRepository->getItemsById($validated['item_id1']);;
            $value1 = $item->value;
            $explorer1_id = $item->explorer_id;
        }

        if (is_array($validated['item_id2'])) {
            foreach ($validated['item_id2'] as $item) {
                $item2 = $this->itemRepository->getItemsById($item);;;
                $value2 += $item2->value;
                $explorer2_id = $item2->explorer_id;
            }
        } else {
            $item = $this->itemRepository->getItemsById($validated['item_id2']);;;
            $value2 = $item->value;
            $explorer2_id = $item->explorer_id;
        }

        if ($value1 != $value2) {
            return "Não foi possível continuar a operação, os valores não são equivalentes";
        } else {
            if (is_array($validated['item_id1'])) {
                foreach ($validated['item_id1'] as $item) {
                    $item1 = $this->itemRepository->getItemsById($item);
                    $item1->update(["explorer_id" => $explorer2_id]);
                }
            } else {
                $item = $this->itemRepository->getItemsById($validated['item_id1']);;
                $item->update(["explorer_id" => $explorer2_id]);
            }


            if (is_array($validated['item_id2'])) {
                foreach ($validated['item_id2'] as $item) {
                    $item2 = $this->itemRepository->getItemsById($item);;
                    $item2->update(["explorer_id" => $explorer1_id]);
                }
            } else {
                $item = $this->itemRepository->getItemsById($validated['item_id2']);
                $item->update(["explorer_id" => $explorer1_id]);
            }
            return "A troca de itens foi concluída!";
        }
    }
}
