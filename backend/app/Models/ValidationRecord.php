<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class ValidationRecord extends Model
{
    /** @use HasFactory<\Database\Factories\ValidationRecordFactory> */
    use HasFactory, HasUlids;
    protected $fillable = ['validatable_type','validatable_id','validator_id','level','status','reason','evidence'];
    protected function casts(): array { return ['evidence' => 'array']; }
    public function validator() { return $this->belongsTo(User::class, 'validator_id'); }
}
