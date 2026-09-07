<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id'=>$this->id,'language_id'=>$this->language_id,'slug'=>$this->slug,'title'=>$this->title,'description'=>$this->description,'status'=>$this->status,'lessons'=>$this->whenLoaded('lessons')];
    }
}
