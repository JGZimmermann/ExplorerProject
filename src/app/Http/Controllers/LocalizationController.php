<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocalizationRequest;
use App\Http\Repositories\LocalizationRepository;

class LocalizationController extends Controller
{
    public function __construct(protected LocalizationRepository $localizationRepository)
    {
    }
    public function index()
    {
        return response()->json($this->localizationRepository->getLocalizations());
    }

    public function show($id)
    {
        return response()->json($this->localizationRepository->getLocalizationById($id));
    }

    public function store(StoreLocalizationRequest $request)
    {
        return response()->json($this->localizationRepository->storeLocalization($request->validated()));
    }
}
