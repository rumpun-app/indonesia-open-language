<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory, HasUlids; protected $fillable = ['course_id','position','title','content','activities']; protected function casts(): array { return ['activities'=>'array']; } public function course() { return $this->belongsTo(Course::class); }
}
