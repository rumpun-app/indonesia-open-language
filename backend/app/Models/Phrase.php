<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Phrase extends Model
{
    /** @use HasFactory<\Database\Factories\PhraseFactory> */
    use HasFactory, HasUlids; protected $fillable = ['language_id','dialect_id','text','translation','literal_translation','context','register','status']; public function language() { return $this->belongsTo(Language::class); } public function dialect() { return $this->belongsTo(Dialect::class); } public function examples() { return $this->hasMany(ExampleSentence::class); }
}
