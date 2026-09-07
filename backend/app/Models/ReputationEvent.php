<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class ReputationEvent extends Model
{
    /** @use HasFactory<\Database\Factories\ReputationEventFactory> */
    use HasFactory, HasUlids; protected $fillable = ['user_id','event_type','points','subject_type','subject_id','metadata']; protected function casts(): array { return ['metadata'=>'array']; } public function user() { return $this->belongsTo(User::class); }
}
