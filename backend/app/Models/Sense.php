<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Sense extends Model
{
    /** @use HasFactory<\Database\Factories\SenseFactory> */
    use HasFactory, HasUlids; protected $fillable = ['lexical_entry_id','position','definition','translation','register','notes']; public function lexicalEntry() { return $this->belongsTo(LexicalEntry::class); }
}
