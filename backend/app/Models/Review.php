<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory, HasUlids;
    protected $fillable = ['contribution_id','reviewer_id','decision','reason','evidence'];
    protected function casts(): array { return ['evidence' => 'array']; }
    public function contribution() { return $this->belongsTo(Contribution::class); }
    public function reviewer() { return $this->belongsTo(User::class, 'reviewer_id'); }
}
