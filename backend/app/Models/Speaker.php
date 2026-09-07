<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Speaker extends Model
{
    /** @use HasFactory<\Database\Factories\SpeakerFactory> */
    use HasFactory, HasUlids; protected $fillable = ['user_id','display_name','consent_status','license']; public function recordings() { return $this->hasMany(AudioRecording::class); }
}
