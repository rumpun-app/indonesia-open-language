<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTokenRequest;

class TokenController extends Controller
{
    public function store(CreateTokenRequest $request) { $data=$request->validated(); $token=$request->user()->createToken($data['name'], $data['abilities'] ?? ['read']); return response()->json(['token'=>$token->plainTextToken,'name'=>$data['name'],'abilities'=>$data['abilities'] ?? ['read']],201); }
    public function index(Request $request) { return response()->json($request->user()->tokens()->latest()->get(['id','name','abilities','last_used_at','created_at'])); }
    public function destroy(Request $request, int $token) { abort_unless($request->user()->tokens()->whereKey($token)->exists(),404); $request->user()->tokens()->whereKey($token)->delete(); return response()->noContent(); }
}
