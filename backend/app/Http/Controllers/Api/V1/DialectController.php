<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDialectRequest;
use App\Http\Resources\DialectResource;
use App\Models\Dialect;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DialectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $language): AnonymousResourceCollection
    {
        return DialectResource::collection(Dialect::where('language_id', $language)->where('status', 'published')->orderBy('name')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDialectRequest $request): DialectResource
    {
        return new DialectResource(Dialect::create($request->validated()));
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
