<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class AnalyticsEvent extends Model
{
    /** @use HasFactory<\Database\Factories\AnalyticsEventFactory> */
    use HasFactory, HasUlids; protected $fillable = ['user_id','event_name','anonymous_id','properties','occurred_at']; protected function casts(): array { return ['properties'=>'array','occurred_at'=>'datetime']; } public function user() { return $this->belongsTo(User::class); }
}
