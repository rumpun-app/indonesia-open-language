<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommunityPostRequest;
use App\Http\Requests\StoreCommunityCommentRequest;
use App\Http\Requests\StoreContentReportRequest;
use App\Models\CommunityPost;
use App\Models\ContentReport;

class CommunityController extends Controller
{
    public function posts() { return CommunityPost::with(['author','comments.author'])->where('status','published')->latest()->paginate(20); }
    public function storePost(StoreCommunityPostRequest $request) { return response()->json(CommunityPost::create($request->validated()+['author_id'=>$request->user()->id]), 201); }
    public function comment(StoreCommunityCommentRequest $request, CommunityPost $post) { abort_unless($post->status==='published',404); return response()->json($post->comments()->create($request->validated()+['author_id'=>$request->user()->id]),201); }
    public function report(StoreContentReportRequest $request) { return response()->json(ContentReport::create($request->validated()+['reporter_id'=>$request->user()->id,'status'=>'open']),201); }
}
