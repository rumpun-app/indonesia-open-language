<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class AudioRecording extends Model
{
    /** @use HasFactory<\Database\Factories\AudioRecordingFactory> */
    use HasFactory, HasUlids; protected $fillable = ['speaker_id','language_id','dialect_id','text','storage_path','processing_status','review_status','license','recorded_at']; protected function casts(): array { return ['recorded_at'=>'datetime']; }
}
