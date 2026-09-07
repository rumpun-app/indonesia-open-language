<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class EntityVersion extends Model
{
    use HasUlids;
    protected $fillable = ['versionable_type','versionable_id','version','snapshot','created_by','source_id','reason'];
    protected function casts(): array { return ['snapshot' => 'array']; }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
    public function source() { return $this->belongsTo(Source::class); }
}
