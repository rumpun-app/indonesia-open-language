<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Region extends Model
{
    /** @use HasFactory<\Database\Factories\RegionFactory> */
    use HasFactory, SoftDeletes, HasUlids;

    protected $fillable = ['name', 'slug', 'country_code', 'type', 'geometry'];
    protected function casts(): array { return ['geometry' => 'array']; }
    public function languages() { return $this->belongsToMany(Language::class); }
    public function dialects() { return $this->belongsToMany(Dialect::class); }
}
