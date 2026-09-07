<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index(Request $request) { abort_unless($request->user()->hasPermission('moderation.manage'),403); return response()->json(AuditLog::with('actor')->latest()->paginate(50)); }
}
