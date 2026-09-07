<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAudioRecordingRequest;
use App\Http\Resources\AudioRecordingResource;
use App\Models\AudioRecording;
use App\Models\Speaker;
use App\Jobs\ProcessAudioRecording;

class AudioController extends Controller
{
    public function index() { return AudioRecordingResource::collection(AudioRecording::latest()->paginate(20)); }

    public function store(StoreAudioRecordingRequest $request): AudioRecordingResource
    {
        $speaker = Speaker::findOrFail($request->validated('speaker_id'));
        abort_unless($request->user()->id === $speaker->user_id || $request->user()->hasPermission('audio.review'), 403);
        $data = $request->validated(); $path = $request->file('audio')->store('audio-recordings', 's3');
        $recording = AudioRecording::create(collect($data)->except('audio')->put('storage_path', $path)->put('processing_status','processing')->all());
        ProcessAudioRecording::dispatch($recording);
        return new AudioRecordingResource($recording);
    }
}
