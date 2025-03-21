<?php

namespace App\Http\Repositories;

use App\Models\Explorer;
use Illuminate\Support\Facades\DB;

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

    public function createExplorer(array $array)
    {
        return Explorer::create($array);
    }

    public function itemConsult($id)
    {
        return DB::table('items')->find($id);
    }


}
