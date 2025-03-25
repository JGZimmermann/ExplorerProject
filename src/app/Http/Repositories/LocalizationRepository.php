<?php

namespace App\Http\Repositories;

use App\Models\Localization;

class LocalizationRepository
{
    public function getLocalizations()
    {
        return Localization::all();
    }

    public function getLocalizationById($id)
    {
        return Localization::findOrFail($id);
    }

    public function storeLocalization($data){
        return Localization::create($data);
    }
}
