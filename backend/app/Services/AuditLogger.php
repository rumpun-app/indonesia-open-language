<?php
namespace App\Services;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogger
{
    public function record(?Request $request, string $action, object $auditable, array $metadata = []): AuditLog
    {
        return AuditLog::create(['actor_id'=>$request?->user()?->id,'action'=>$action,'auditable_type'=>$auditable::class,'auditable_id'=>(string)$auditable->getKey(),'metadata'=>$metadata,'ip_address'=>$request?->ip(),'user_agent'=>$request?->userAgent()]);
    }
}
