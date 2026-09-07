<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Language extends Model
{
    /** @use HasFactory<\Database\Factories\LanguageFactory> */
    use HasFactory, SoftDeletes, HasUlids;

    protected $fillable = ['slug', 'name', 'native_name', 'iso_code', 'description', 'status', 'metadata'];
    protected function casts(): array { return ['metadata' => 'array']; }
    public function dialects() { return $this->hasMany(Dialect::class); }
    public function regions() { return $this->belongsToMany(Region::class); }
    public function scripts() { return $this->belongsToMany(Script::class); }
    public function grammarRules() { return $this->hasMany(GrammarRule::class); }
}
