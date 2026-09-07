<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContributionRequest;
use App\Http\Requests\SubmitContributionRequest;
use App\Models\Contribution;
use App\Http\Requests\PublishContributionRequest;
use App\Services\PublishContribution;
use App\Services\AuditLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Contribution::query()->latest()->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContributionRequest $request, AuditLogger $audit): JsonResponse
    {
        $contribution = Contribution::create($request->validated() + ['author_id' => $request->user()->id]); $audit->record($request, 'contribution.created', $contribution);
        return response()->json($contribution, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contribution $contribution): JsonResponse
    {
        return response()->json($contribution);
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

    public function submit(SubmitContributionRequest $request, Contribution $contribution, AuditLogger $audit): JsonResponse
    {
        abort_unless($contribution->author_id === $request->user()->id && $contribution->status === 'draft', 403);
        $contribution->update(['status' => 'submitted', 'submitted_at' => now()]);
        $audit->record($request, 'contribution.submitted', $contribution);
        return response()->json($contribution->fresh());
    }

    public function publish(PublishContributionRequest $request, Contribution $contribution, PublishContribution $publisher, AuditLogger $audit): JsonResponse
    {
        $published = $publisher->execute($contribution, $request->user()->id); $audit->record($request, 'contribution.published', $published); return response()->json($published);
    }
}
