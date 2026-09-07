<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class AuditLog extends Model
{
    /** @use HasFactory<\Database\Factories\AuditLogFactory> */
    use HasFactory, HasUlids; protected $fillable=['actor_id','action','auditable_type','auditable_id','metadata','ip_address','user_agent']; protected function casts():array{return ['metadata'=>'array'];} public function actor(){return $this->belongsTo(User::class,'actor_id');}
}
