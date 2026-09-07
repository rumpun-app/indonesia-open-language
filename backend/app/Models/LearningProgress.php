<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningProgress extends Model
{
    /** @use HasFactory<\Database\Factories\LearningProgressFactory> */
    use HasFactory; protected $fillable = ['user_id','course_id','lesson_id','xp','streak','completed_at']; protected function casts(): array { return ['completed_at'=>'datetime']; }
}
