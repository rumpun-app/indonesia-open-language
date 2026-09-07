<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return LanguageResource::collection(Language::query()->where('status', 'published')->orderBy('name')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request): LanguageResource
    {
        return new LanguageResource(Language::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language): LanguageResource
    {
        return new LanguageResource($language);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
