<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Contribution extends Model
{
    /** @use HasFactory<\Database\Factories\ContributionFactory> */
    use HasFactory, HasUlids;
    protected $fillable = ['author_id','type','status','target_type','target_id','change_set','reason','evidence','submitted_at'];
    protected function casts(): array { return ['change_set' => 'array', 'evidence' => 'array', 'submitted_at' => 'datetime']; }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function reviews() { return $this->hasMany(Review::class); }
}
