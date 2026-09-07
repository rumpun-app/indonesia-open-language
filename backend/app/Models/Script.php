<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Script extends Model
{
    /** @use HasFactory<\Database\Factories\ScriptFactory> */
    use HasFactory, HasUlids; protected $fillable=['slug','name','native_name','iso_code','description']; public function languages(){return $this->belongsToMany(Language::class);}
}
