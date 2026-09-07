<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLexicalEntryRequest;
use App\Http\Resources\LexicalEntryResource;
use App\Models\LexicalEntry;
use Illuminate\Support\Facades\DB;

class DictionaryController extends Controller
{
    public function index(Request $request)
    {
        $query = LexicalEntry::with(['wordForms','senses'])->where('status','published');
        if ($request->filled('q')) { $term = $request->string('q'); $query->whereHas('wordForms', fn ($q) => $q->where('form','like',"%{$term}%"))->orWhereHas('senses', fn ($q) => $q->where('definition','like',"%{$term}%")); }
        if ($request->filled('language_id')) $query->where('language_id', $request->string('language_id'));
        return LexicalEntryResource::collection($query->latest()->paginate(20));
    }

    public function show(LexicalEntry $lexicalEntry): LexicalEntryResource { return new LexicalEntryResource($lexicalEntry->load(['wordForms','senses','examples'])); }

    public function store(StoreLexicalEntryRequest $request): LexicalEntryResource
    {
        $data = $request->validated();
        $entry = DB::transaction(function () use ($data) {
            $entry = LexicalEntry::create(collect($data)->except(['word_forms','senses'])->put('status', $data['status'] ?? 'draft')->all());
            $entry->wordForms()->createMany($data['word_forms']); $entry->senses()->createMany($data['senses']); return $entry;
        });
        return new LexicalEntryResource($entry->load(['wordForms','senses']));
    }
}
