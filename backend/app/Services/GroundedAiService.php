<?php

namespace App\Services;

use App\Contracts\AiProvider;

class GroundedAiService
{
    public function __construct(private readonly AiProvider $provider) {}

    public function answer(string $query, array $documents): array
    {
        if ($documents === []) return ['answer' => null, 'confidence' => 0, 'status' => 'insufficient_evidence'];
        return $this->provider->answer($query, $documents);
    }
}
