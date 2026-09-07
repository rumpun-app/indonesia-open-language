<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class ContentReport extends Model
{
    /** @use HasFactory<\Database\Factories\ContentReportFactory> */
    use HasFactory, HasUlids; protected $fillable = ['reporter_id','reportable_type','reportable_id','reason','details','status','resolution','resolved_by']; public function reporter() { return $this->belongsTo(User::class,'reporter_id'); }
}
