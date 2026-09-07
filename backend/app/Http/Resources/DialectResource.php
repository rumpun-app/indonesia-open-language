<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DialectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id' => $this->id, 'language_id' => $this->language_id, 'slug' => $this->slug, 'name' => $this->name, 'native_name' => $this->native_name, 'description' => $this->description, 'status' => $this->status];
    }
}
