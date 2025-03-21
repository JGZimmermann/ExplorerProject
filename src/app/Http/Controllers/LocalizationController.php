<?php

namespace App\Http\Controllers;

use App\Models\Localization;
use App\Http\Requests\StoreLocalizationRequest;

class LocalizationController extends Controller
{
    public function index()
    {
        $localizations = Localization::all();
        return response()->json($localizations);
    }

    public function show(Localization $localization)
    {
        return response()->json($localization);
    }

    public function store(StoreLocalizationRequest $request)
    {
        $validated = $request->validated();
        $localization = Localization::create($validated);
        return response()->json($localization);
    }
}
