<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnalyticsEventRequest;
use App\Models\AnalyticsEvent;
use App\Models\ReputationEvent;

class AnalyticsController extends Controller
{
    public function store(StoreAnalyticsEventRequest $request) { $data=$request->validated(); return response()->json(AnalyticsEvent::create($data+['user_id'=>$request->user()?->id,'occurred_at'=>$data['occurred_at']??now()]),201); }
    public function reputation(\Illuminate\Http\Request $request) { $events=ReputationEvent::where('user_id',$request->user()->id)->latest()->get(); return response()->json(['points'=>$events->sum('points'),'events'=>$events]); }
}
