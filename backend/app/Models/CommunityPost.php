<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class CommunityPost extends Model
{
    /** @use HasFactory<\Database\Factories\CommunityPostFactory> */
    use HasFactory, HasUlids; protected $fillable = ['author_id','language_id','dialect_id','title','body','status','target_type','target_id']; public function comments() { return $this->hasMany(CommunityComment::class,'post_id'); } public function author() { return $this->belongsTo(User::class,'author_id'); }
}
