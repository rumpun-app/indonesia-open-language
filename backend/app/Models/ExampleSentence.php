<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class ExampleSentence extends Model
{
    /** @use HasFactory<\Database\Factories\ExampleSentenceFactory> */
    use HasFactory, HasUlids; protected $fillable = ['language_id','dialect_id','lexical_entry_id','phrase_id','text','translation','context','status']; public function lexicalEntry() { return $this->belongsTo(LexicalEntry::class); } public function phrase() { return $this->belongsTo(Phrase::class); }
}
