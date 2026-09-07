<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AudioRecordingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id'=>$this->id,'speaker_id'=>$this->speaker_id,'language_id'=>$this->language_id,'dialect_id'=>$this->dialect_id,'text'=>$this->text,'storage_path'=>$this->storage_path,'processing_status'=>$this->processing_status,'review_status'=>$this->review_status,'license'=>$this->license,'recorded_at'=>$this->recorded_at?->toISOString()];
    }
}
