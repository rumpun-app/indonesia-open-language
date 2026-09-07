<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;

class LexicalEntry extends Model
{
    /** @use HasFactory<\Database\Factories\LexicalEntryFactory> */
    use HasFactory, HasUlids, SoftDeletes;
    protected $fillable = ['language_id','dialect_id','region_id','part_of_speech','register','notes','status','metadata'];
    protected function casts(): array { return ['metadata' => 'array']; }
    public function language() { return $this->belongsTo(Language::class); }
    public function dialect() { return $this->belongsTo(Dialect::class); }
    public function region() { return $this->belongsTo(Region::class); }
    public function wordForms() { return $this->hasMany(WordForm::class); }
    public function senses() { return $this->hasMany(Sense::class)->orderBy('position'); }
    public function examples() { return $this->hasMany(ExampleSentence::class); }
}
