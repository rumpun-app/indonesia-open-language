<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Source extends Model
{
    /** @use HasFactory<\Database\Factories\SourceFactory> */
    use HasFactory, HasUlids;
    protected $fillable = ['type','title','author','url','citation','license','notes','metadata'];
    protected function casts(): array { return ['metadata' => 'array']; }
}
