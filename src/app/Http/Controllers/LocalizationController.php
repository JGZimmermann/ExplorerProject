<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localization;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $localization = Localization::create($validated);
        return response()->json($localization);
    }
}
