<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id' => $this->id, 'slug' => $this->slug, 'name' => $this->name, 'native_name' => $this->native_name, 'iso_code' => $this->iso_code, 'description' => $this->description, 'status' => $this->status, 'metadata' => $this->metadata, 'created_at' => $this->created_at?->toISOString()];
    }
}
