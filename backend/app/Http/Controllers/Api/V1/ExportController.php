<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function __invoke(\Illuminate\Http\Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $rows = \App\Models\Language::with('dialects')->where('status','published')->get()->map(fn ($language) => ['language' => $language->slug, 'name' => $language->name, 'dialects' => $language->dialects->pluck('slug')->values()]);
        $format = $request->string('format', 'json')->toString();
        abort_unless(in_array($format, ['json','jsonl','csv'], true), 422, 'Unsupported export format.');
        if ($format === 'json') return response()->json(['format' => 'json', 'generated_at' => now()->toISOString(), 'data' => $rows]);
        if ($format === 'jsonl') return response($rows->map(fn ($row) => json_encode($row, JSON_UNESCAPED_UNICODE))->implode("\n"), 200, ['Content-Type'=>'application/x-ndjson']);
        $csv = collect([['language','name','dialects']])->merge($rows->map(fn ($row) => [$row['language'],$row['name'],$row['dialects']->implode('|')]))->map(fn ($line) => collect($line)->map(fn ($value) => '"'.str_replace('"','""',(string)$value).'"')->implode(','))->implode("\n");
        return response($csv, 200, ['Content-Type'=>'text/csv','Content-Disposition'=>'attachment; filename="languages.csv"']);
    }
}
