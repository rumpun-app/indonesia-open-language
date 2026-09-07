<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Dialect extends Model
{
    /** @use HasFactory<\Database\Factories\DialectFactory> */
    use HasFactory, SoftDeletes, HasUlids;

    protected $fillable = ['language_id', 'slug', 'name', 'native_name', 'description', 'status'];
    public function language() { return $this->belongsTo(Language::class); }
    public function regions() { return $this->belongsToMany(Region::class); }
}
