<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSourceRequest;
use App\Http\Resources\SourceResource;
use App\Models\Source;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return SourceResource::collection(Source::latest()->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSourceRequest $request): SourceResource
    {
        return new SourceResource(Source::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
