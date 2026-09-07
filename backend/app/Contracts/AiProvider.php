<?php

namespace App\Contracts;

interface AiProvider
{
    public function answer(string $prompt, array $context = []): array;
}
