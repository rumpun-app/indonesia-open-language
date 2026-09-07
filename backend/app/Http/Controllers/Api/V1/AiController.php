<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AiController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate(['query' => ['required','string','max:500']]);
        return response()->json(['answer' => null, 'confidence' => 0, 'status' => 'insufficient_evidence', 'message' => 'No grounded language data is available for this query yet.']);
    }
}
