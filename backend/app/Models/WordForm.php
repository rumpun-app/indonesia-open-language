<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class WordForm extends Model
{
    /** @use HasFactory<\Database\Factories\WordFormFactory> */
    use HasFactory, HasUlids; protected $fillable = ['lexical_entry_id','form','script','pronunciation','is_lemma']; protected function casts(): array { return ['is_lemma'=>'boolean']; } public function lexicalEntry() { return $this->belongsTo(LexicalEntry::class); }
}
