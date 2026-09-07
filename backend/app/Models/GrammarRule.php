<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class GrammarRule extends Model
{
    /** @use HasFactory<\Database\Factories\GrammarRuleFactory> */
    use HasFactory, HasUlids; protected $fillable=['language_id','dialect_id','category','title','description','examples','status']; protected function casts():array{return ['examples'=>'array'];} public function language(){return $this->belongsTo(Language::class);} public function dialect(){return $this->belongsTo(Dialect::class);}
}
