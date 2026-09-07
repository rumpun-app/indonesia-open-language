<?php

namespace App\Services;

use App\Contracts\AiProvider;

class NullAiProvider implements AiProvider
{
    public function answer(string $prompt, array $context = []): array
    {
        return ['answer' => null, 'confidence' => 0, 'status' => 'provider_not_configured'];
    }
}
