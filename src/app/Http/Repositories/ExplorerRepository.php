<?php

namespace App\Http\Repositories;

use App\Models\Explorer;

class ExplorerRepository
{
    public function getAllExplorers()
    {
        return Explorer::all();
    }

    public function getExplorerById($id)
    {
        return Explorer::findOrFail($id);
    }

    public function createExplorer($request)
    {
        return Explorer::create($request);
    }

    public function updateExplorer(Explorer $explorer, $request)
    {
        return $explorer->update($request);
    }
}
