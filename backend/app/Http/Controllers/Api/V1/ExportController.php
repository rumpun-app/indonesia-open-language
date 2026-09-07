<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $rows = \App\Models\Language::with('dialects')->where('status','published')->get()->map(fn ($language) => ['language' => $language->slug, 'name' => $language->name, 'dialects' => $language->dialects->pluck('slug')->values()]);
        return response()->json(['format' => 'json', 'generated_at' => now()->toISOString(), 'data' => $rows]);
    }
}
