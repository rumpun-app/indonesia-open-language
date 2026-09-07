<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class CommunityComment extends Model
{
    /** @use HasFactory<\Database\Factories\CommunityCommentFactory> */
    use HasFactory, HasUlids; protected $fillable = ['post_id','author_id','body','status']; public function post() { return $this->belongsTo(CommunityPost::class,'post_id'); } public function author() { return $this->belongsTo(User::class,'author_id'); }
}
