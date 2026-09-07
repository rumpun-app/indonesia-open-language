<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LexicalEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id'=>$this->id, 'language_id'=>$this->language_id, 'dialect_id'=>$this->dialect_id, 'region_id'=>$this->region_id, 'status'=>$this->status, 'part_of_speech'=>$this->part_of_speech, 'register'=>$this->register, 'word_forms'=>$this->whenLoaded('wordForms', fn () => $this->wordForms), 'senses'=>$this->whenLoaded('senses', fn () => $this->senses), 'examples'=>$this->whenLoaded('examples', fn () => $this->examples)];
    }
}
