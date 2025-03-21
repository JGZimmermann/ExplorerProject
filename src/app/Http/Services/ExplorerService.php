<?php

namespace App\Http\Services;

use App\Http\Repositories\ExplorerRepository;

class ExplorerService
{
    public function __construct(protected ExplorerRepository $explorerRepository)
    {
    }

    public function getExplorers()
    {
        return $this->explorerRepository->getAllExplorers();
    }

    public function storeExplorer(array $array)
    {
        return $this->explorerRepository->createExplorer($array);
    }

    public function getExplorerById($id)
    {
        return $this->explorerRepository->getExplorerById($id);
    }

    public function itemConsult($id)
    {
        return $this->explorerRepository->itemConsult($id);
    }
}
